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
            'metode_pengambilan' => 'delivery',
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

        $this->session->set_flashdata('success', 'Pesanan berhasil dibuat.');
        redirect('collection');
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
}