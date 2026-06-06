<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pesanan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pesanan_model');
    }

    public function form($id_pakaian_jadi)
    {
        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'customer'){
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('login_customer');
        }

        $id_user = $this->session->userdata('id_user');

        $data['produk'] = $this->pesanan_model->get_produk($id_pakaian_jadi);
        $data['customer'] = $this->pesanan_model->get_customer_by_user($id_user);

        if(!$data['produk']){
            show_404();
        }

        $this->load->view('customer/pesanan_form', $data);
    }

    public function simpan()
    {
        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'customer'){
            redirect('login_customer');
        }

        $id_pakaian_jadi = $this->input->post('id_pakaian_jadi', true);
        $produk = $this->pesanan_model->get_produk($id_pakaian_jadi);

        if(!$produk){
            show_404();
        }

        $jumlah = (int) $this->input->post('jumlah', true);

        if($jumlah < 1){
            $jumlah = 1;
        }

        if($jumlah > $produk->stok){
            $this->session->set_flashdata('error', 'Jumlah pesanan melebihi stok tersedia.');
            redirect('pesanan/form/'.$id_pakaian_jadi);
        }

        $harga_normal = $produk->harga;
        $diskon = $produk->diskon_produk;
        $harga_setelah_diskon = $harga_normal - ($harga_normal * $diskon / 100);
        $subtotal = $harga_setelah_diskon * $jumlah;

        $data_pesanan = [
            'id_customer'        => $this->input->post('id_customer', true),
            'id_request'         => NULL,
            'kode_pesanan'       => 'PSN-' . date('YmdHis'),
            'total_bayar'        => $subtotal,
            'tipe_pesanan'       => 'pakaian_jadi',
            'status_pesanan'     => 'pending',
            'metode_pengambilan' => $this->input->post('metode_pengambilan', true),
            'alamat_pengiriman'  => $this->input->post('alamat_pengiriman', true),
            'ekspedisi'          => $this->input->post('ekspedisi', true),
            'metode_pembayaran'  => $this->input->post('metode_pembayaran', true)
        ];

        $id_pesanan = $this->pesanan_model->insert_pesanan($data_pesanan);

        $data_detail = [
            'id_pesanan'      => $id_pesanan,
            'id_pakaian_jadi' => $id_pakaian_jadi,
            'id_request'      => NULL,
            'jumlah'          => $jumlah,
            'harga'           => $harga_setelah_diskon,
            'subtotal'        => $subtotal
        ];

        $this->pesanan_model->insert_detail_pesanan($data_detail);

        $data_pembayaran = [
            'id_pesanan'         => $id_pesanan,
            'id_request'         => NULL,
            'kode_pembayaran'    => 'PAY-' . date('YmdHis'),
            'jenis_pembayaran'   => 'full_payment',
            'metode_pembayaran'  => $this->input->post('metode_pembayaran', true),
            'jumlah_bayar'       => $subtotal,
            'bukti_pembayaran'   => NULL,
            'status_pembayaran'  => $this->input->post('metode_pembayaran', true) == 'cash'
                ? 'belum_bayar'
                : 'belum_bayar'
        ];

        $this->pesanan_model->insert_pembayaran($data_pembayaran);

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

        $pesanan = $this->pesanan_model->get_detail_riwayat($id_pesanan, $id_user);

        if(!$pesanan){
            show_404();
        }

        $data['pesanan'] = $pesanan;
        $data['detail_produk'] = $this->pesanan_model->get_detail_produk_pesanan($id_pesanan);

        $this->load->view('customer/riwayat_detail', $data);
    }

    public function konfirmasi_pembayaran()
    {
        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'customer'){
            redirect('login');
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
            'jenis_pembayaran'  => 'pembayaran berhasil',
            'judul_notifikasi'  => 'Konfirmasi Pembayaran Baru',
            'pesan_notifikasi'  => $pesanan->nama_user . ' telah mengupload bukti pembayaran untuk pesanan ' . $pesanan->kode_pesanan . '.',
            'status_baca'       => 'belum_dibaca'
        ]);

        $this->session->set_flashdata('payment_success', 'Bukti pembayaran berhasil disimpan.');
        redirect('pesanan/detail/'.$id_pesanan);
    }

    public function download_invoice($id_pesanan)
    {
        $data['pesanan'] =
            $this->Pesanan_model
                ->get_detail_pesanan($id_pesanan);

        $this->load->view(
            'customer/invoice_pdf',
            $data
        );
    }
}