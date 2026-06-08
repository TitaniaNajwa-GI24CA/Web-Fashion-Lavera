<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pesanan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pesanan_model');
    }

    public function form($id_pakaian_jadi = null)
    {
        if(
            $this->session->userdata('login') != TRUE ||
            $this->session->userdata('role') != 'customer'
        ){
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('login_customer');
        }

        $id_user = $this->session->userdata('id_user');

        $customer = $this->pesanan_model->get_customer_by_user($id_user);

        if(!$customer){
            show_404();
        }

        $data['customer'] = $customer;

        if($id_pakaian_jadi != null){

            $produk = $this->pesanan_model->get_produk($id_pakaian_jadi);

            if(!$produk){
                show_404();
            }

            $data['checkout_type'] = 'single';
            $data['produk'] = $produk;
            $data['cart_items'] = [];

        }else{

            $cart_items = $this->pesanan_model->get_cart_customer($customer->id_customer);

            if(empty($cart_items)){
                $this->session->set_flashdata('error', 'Keranjang masih kosong.');
                redirect('cart');
            }

            $data['checkout_type'] = 'cart';
            $data['produk'] = null;
            $data['cart_items'] = $cart_items;
        }

        $this->load->view('customer/pesanan_form', $data);
    }

    public function simpan()
    {
        if(
            $this->session->userdata('login') != TRUE ||
            $this->session->userdata('role') != 'customer'
        ){
            redirect('login_customer');
        }

        $id_user = $this->session->userdata('id_user');
        $customer = $this->pesanan_model->get_customer_by_user($id_user);

        if(!$customer){
            show_404();
        }

        $checkout_type = $this->input->post('checkout_type', true);

        $items = [];
        $grand_total = 0;

        if($checkout_type == 'single'){

            $id_pakaian_jadi = $this->input->post('id_pakaian_jadi', true);
            $jumlah = (int) $this->input->post('jumlah', true);

            if($jumlah < 1){
                $jumlah = 1;
            }

            $produk = $this->pesanan_model->get_produk($id_pakaian_jadi);

            if(!$produk){
                show_404();
            }

            if($jumlah > $produk->stok){
                $this->session->set_flashdata('error', 'Jumlah pesanan melebihi stok tersedia.');
                redirect('pesanan/form/'.$id_pakaian_jadi);
            }

            $harga = $produk->harga - ($produk->harga * $produk->diskon_produk / 100);
            $subtotal = $harga * $jumlah;

            $items[] = [
                'id_pakaian_jadi' => $produk->id_pakaian_jadi,
                'jumlah'          => $jumlah,
                'harga'           => $harga,
                'subtotal'        => $subtotal
            ];

            $grand_total += $subtotal;

        }else{

            $cart_items = $this->pesanan_model->get_cart_customer($customer->id_customer);

            if(empty($cart_items)){
                $this->session->set_flashdata('error', 'Keranjang masih kosong.');
                redirect('cart');
            }

            foreach($cart_items as $c){

                if($c->jumlah > $c->stok){
                    $this->session->set_flashdata('error', 'Jumlah produk '.$c->nama_pakaian.' melebihi stok.');
                    redirect('cart');
                }

                $harga = $c->harga - ($c->harga * $c->diskon_produk / 100);
                $subtotal = $harga * $c->jumlah;

                $items[] = [
                    'id_pakaian_jadi' => $c->id_pakaian_jadi,
                    'jumlah'          => $c->jumlah,
                    'harga'           => $harga,
                    'subtotal'        => $subtotal
                ];

                $grand_total += $subtotal;
            }
        }

        $data_pesanan = [
            'id_customer'        => $customer->id_customer,
            'id_request'         => NULL,
            'kode_pesanan'       => 'PSN-' . date('YmdHis'),
            'total_bayar'        => $grand_total,
            'tipe_pesanan'       => 'pakaian_jadi',
            'status_pesanan'     => 'pending',
            'metode_pengambilan' => $this->input->post('metode_pengambilan', true),
            'alamat_pengiriman'  => $this->input->post('alamat_pengiriman', true),
            'ekspedisi'          => $this->input->post('ekspedisi', true),
            'metode_pembayaran'  => $this->input->post('metode_pembayaran', true)
        ];

        $id_pesanan = $this->pesanan_model->insert_pesanan($data_pesanan);

        foreach($items as $item){

            $this->pesanan_model->insert_detail_pesanan([
                'id_pesanan'      => $id_pesanan,
                'id_pakaian_jadi' => $item['id_pakaian_jadi'],
                'id_request'      => NULL,
                'jumlah'          => $item['jumlah'],
                'harga'           => $item['harga'],
                'subtotal'        => $item['subtotal']
            ]);

            $this->pesanan_model->kurangi_stok(
                $item['id_pakaian_jadi'],
                $item['jumlah']
            );
        }

        $this->pesanan_model->insert_pembayaran([
            'id_pesanan'         => $id_pesanan,
            'id_request'         => NULL,
            'kode_pembayaran'    => 'PAY-' . date('YmdHis'),
            'jenis_pembayaran'   => 'pembayaran_pakaian_jadi',
            'metode_pembayaran'  => $this->input->post('metode_pembayaran', true),
            'jumlah_bayar'       => $grand_total,
            'bukti_pembayaran'   => NULL,
            'status_pembayaran'  => 'belum_bayar'
        ]);

        if($checkout_type == 'cart'){
            $this->pesanan_model->clear_cart($customer->id_customer);
        }

        $this->session->set_flashdata('success', 'Pesanan berhasil dibuat.');
        redirect('riwayat-pesanan');
    }

    public function riwayat()
    {
        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'customer'){
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('login_customer');
        }

        $id_user = $this->session->userdata('id_user');

        $data['riwayat'] = $this->pesanan_model->get_riwayat_all($id_user);

        $this->load->view('customer/riwayat_pesanan', $data);
    }

    public function detail($id_pesanan)
    {
        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'customer'){
            redirect('login_customer');
        }

        $id_user = $this->session->userdata('id_user');
        $cek = $this->pesanan_model->get_detail_riwayat($id_pesanan, $id_user);

        if(!$cek){
            show_404();
        }

        if($cek->tipe_pesanan == 'custom'){

            $data['pesanan'] =
                $this->pesanan_model->get_detail_custom($id_pesanan, $id_user);

            $this->load->view('customer/riwayat_detail_custom', $data);

        }else{

            $data['pesanan'] = $cek;

            $data['detail_produk'] =
                $this->pesanan_model->get_detail_produk_pesanan($id_pesanan);

            $this->load->view('customer/riwayat_detail', $data);
        }
    }

    public function konfirmasi_pembayaran()
    {
        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'customer'){
            redirect('login_customer');
        }

        $id_pesanan = $this->input->post('id_pesanan', true);
        $id_user = $this->session->userdata('id_user');
        $pesanan = $this->pesanan_model->get_detail_riwayat($id_pesanan, $id_user);

        if(!$pesanan){
            show_404();
        }

        if(empty($_FILES['bukti_pembayaran']['name'])){
            $this->session->set_flashdata('error', 'Bukti pembayaran wajib diupload.');
            redirect('pesanan/detail/'.$id_pesanan);
        }

        $upload_path = FCPATH . 'assets/img/pembayaran/';

        if(!is_dir($upload_path)){
            mkdir($upload_path, 0777, true);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('bukti_pembayaran')){
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('pesanan/detail/'.$id_pesanan);
        }

        $bukti = $this->upload->data('file_name');

        $this->pesanan_model->update_pembayaran_by_pesanan($id_pesanan, [
            'bukti_pembayaran'  => $bukti,
            'status_pembayaran' => 'menunggu_verifikasi',
            'tanggal_pembayaran'=> date('Y-m-d H:i:s')
        ]);

        $this->pesanan_model->update_pesanan($id_pesanan, [
            'status_pesanan' => 'diproses'
        ]);

        $this->pesanan_model->insert_notifikasi([
            'id_customer'       => $pesanan->id_customer,
            'id_pesanan'        => $id_pesanan,
            'id_pembayaran'     => $pesanan->id_pembayaran,
            'id_request'        => NULL,
            'target_role'       => 'kasir',
            'jenis_notifikasi'  => 'Bukti Pembayaran',
            'judul_notifikasi'  => 'Konfirmasi Pembayaran Baru',
            'pesan_notifikasi'  => $pesanan->nama_user . ' telah mengupload bukti pembayaran untuk pesanan ' . $pesanan->kode_pesanan . '.',
            'status_baca'       => 'belum_dibaca'
        ]);

        $this->session->set_flashdata('payment_success', 'Bukti pembayaran berhasil disimpan.');
        redirect('pesanan/detail/'.$id_pesanan);
    }

    public function simpan_pembayaran_custom()
    {
        if(
        $this->session->userdata('login') != TRUE ||
        $this->session->userdata('role') != 'customer'
        ){
        redirect('login_customer');
        }

        $id_pesanan       = $this->input->post('id_pesanan', true);
        $id_pembayaran    = $this->input->post('id_pembayaran', true);
        $jenis_pembayaran = $this->input->post('jenis_pembayaran', true);
        $metode           = $this->input->post('metode_pembayaran', true);

        $id_user = $this->session->userdata('id_user');

        $pesanan =
            $this->pesanan_model
                ->get_detail_custom($id_pesanan, $id_user);

        if(!$pesanan){
            show_404();
        }

        $data_update = [
            'metode_pembayaran' => $metode,
            'tanggal_pembayaran' => date('Y-m-d H:i:s')
        ];

        if($metode == 'transfer'){

            if(empty($_FILES['bukti_pembayaran']['name'])){

                $this->session->set_flashdata(
                    'error',
                    'Bukti pembayaran wajib diupload.'
                );

                redirect('pesanan/detail/'.$id_pesanan);
            }

            $upload_path = FCPATH . 'assets/img/pembayaran/';

            if(!is_dir($upload_path)){
                mkdir($upload_path, 0777, true);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('bukti_pembayaran')){

                $this->session->set_flashdata(
                    'error',
                    $this->upload->display_errors()
                );

                redirect('pesanan/detail/'.$id_pesanan);
            }

            $upload = $this->upload->data();

            $data_update['bukti_pembayaran']
                = $upload['file_name'];

            $data_update['status_pembayaran']
                = 'menunggu_verifikasi';
        }

        else{

            $data_update['status_pembayaran']
                = 'menunggu_pembayaran_cash';
        }

        $this->db
            ->where('id_pembayaran', $id_pembayaran)
            ->update('tbl_pembayaran', $data_update);

        $this->pesanan_model->insert_notifikasi([

            'id_customer'      => $pesanan->id_customer,
            'id_pesanan'       => $id_pesanan,
            'id_pembayaran'    => $id_pembayaran,
            'id_request'       => $pesanan->id_request,

            'target_role'      => 'kasir',

            'jenis_notifikasi' => $jenis_pembayaran,

            'judul_notifikasi' =>
                $jenis_pembayaran == 'uang_muka_custom'
                ? 'Pembayaran Uang Muka Baru'
                : 'Pembayaran Pelunasan Baru',

            'pesan_notifikasi' =>

                $pesanan->nama_user .

                (
                    $jenis_pembayaran == 'uang_muka_custom'
                    ? ' telah melakukan pembayaran uang muka untuk pesanan '
                    : ' telah melakukan pembayaran pelunasan untuk pesanan '
                )

                . $pesanan->kode_pesanan,

            'status_baca' => 'belum_dibaca'
        ]);

        $this->session->set_flashdata(
            'payment_success',
            'Pembayaran berhasil dikirim dan menunggu verifikasi kasir.'
        );

        redirect('pesanan/detail/'.$id_pesanan);
    }


    public function download_invoice($id_pesanan)
    {
        $data['pesanan'] =
            $this->pesanan_model
                ->get_detail_pesanan($id_pesanan);

        $this->load->view(
            'customer/invoice_pdf',
            $data
        );
    }

    public function nota_pakaian_jadi($id_pesanan)
    {
        if($this->session->userdata('login') != TRUE){
            redirect('login_customer');
        }

        $role = $this->session->userdata('role');
        $id_user = $this->session->userdata('id_user');

        if($role == 'customer'){
            $data['nota'] =
                $this->pesanan_model->get_nota_pakaian_jadi($id_pesanan, $id_user);
        }else{
            $data['nota'] =
                $this->pesanan_model->get_nota_pakaian_jadi_admin($id_pesanan);
        }

        if(!$data['nota']){
            show_404();
        }

        $this->load->view('customer/nota_pakaian_jadi', $data);
    }

    public function nota_custom($id_pesanan)
    {
        if($this->session->userdata('login') != TRUE){
            redirect('login_customer');
        }

        $role = $this->session->userdata('role');
        $id_user = $this->session->userdata('id_user');

        if($role == 'customer'){
            $data['nota'] =
                $this->pesanan_model->get_nota_custom($id_pesanan, $id_user);
        }else{
            $data['nota'] =
                $this->pesanan_model->get_nota_custom_admin($id_pesanan);
        }

        if(!$data['nota']){
            show_404();
        }

        $this->load->view('customer/nota_custom', $data);
    }
}