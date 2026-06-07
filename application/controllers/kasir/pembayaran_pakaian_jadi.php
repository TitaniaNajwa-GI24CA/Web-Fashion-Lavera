<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pembayaran_pakaian_jadi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('kasir/pembayaran_pakaian_jadi_model');
        $this->load->model('kasir/dashboard_kasir_model');

        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'kasir'){
            redirect('staff-login');
        }
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $data['admin_profile'] = $this->dashboard_kasir_model->get_kasir_profile($id_user);
        $data['page_title'] = 'Pembayaran Pakaian Jadi';
        $data['page_subtitle'] = 'Kelola pembayaran pakaian jadi customer Lavéra.';

        $data['pembayaran'] = $this->pembayaran_pakaian_jadi_model->get_all();
        $data['pesanan_cash'] = $this->pembayaran_pakaian_jadi_model->get_pesanan_belum_cash();

        $this->load->view('kasir/layouts/header');
        $this->load->view('kasir/layouts/sidebar');
        $this->load->view('kasir/layouts/topbar', $data);
        $this->load->view('kasir/pembayaran/pembayaran_pakaian_jadi', $data);
        $this->load->view('kasir/layouts/footer');
    }

    public function simpan_cash()
    {
        $id_pesanan = $this->input->post('id_pesanan', true);
        $jumlah_bayar = $this->input->post('jumlah_bayar', true);

        $data = [
            'id_pesanan' => $id_pesanan,
            'id_request' => NULL,
            'kode_pembayaran' => 'BYR-' . date('YmdHis'),
            'jenis_pembayaran' => 'full_payment',
            'metode_pembayaran' => 'cash',
            'jumlah_bayar' => $jumlah_bayar,
            'bukti_pembayaran' => NULL,
            'status_pembayaran' => 'berhasil',
            'tanggal_pembayaran' => date('Y-m-d H:i:s')
        ];

        $this->pembayaran_pakaian_jadi_model->insert($data);

        $this->pembayaran_pakaian_jadi_model->update_pesanan($id_pesanan, [
            'status_pesanan' => 'diproses'
        ]);

        $this->session->set_flashdata('success', 'Pembayaran cash berhasil ditambahkan.');
        redirect('kasir/pembayaran-pakaian-jadi');
    }

    public function update_status()
    {
    $id_pembayaran = $this->input->post('id_pembayaran', true);
    $status_pembayaran = $this->input->post('status_pembayaran', true);

    $pembayaran_lama =
        $this->pembayaran_pakaian_jadi_model
            ->get_by_id($id_pembayaran);

    if(!$pembayaran_lama){
        show_404();
    }

    $this->pembayaran_pakaian_jadi_model->update(
        $id_pembayaran,
        [
            'status_pembayaran' => $status_pembayaran
        ]
    );
    if(
        $status_pembayaran == 'berhasil'
        &&
        $pembayaran_lama->status_pembayaran != 'berhasil'
    ){

        $this->pembayaran_pakaian_jadi_model->update_pesanan(
            $pembayaran_lama->id_pesanan,
            [
                'status_pesanan' => 'diproses'
            ]
        );

        $this->pembayaran_pakaian_jadi_model->insert_notifikasi([
            'id_customer'       => $pembayaran_lama->id_customer,
            'id_pesanan'        => $pembayaran_lama->id_pesanan,
            'id_pembayaran'     => $id_pembayaran,
            'id_request'        => NULL,
            'target_role'       => 'customer',

            'jenis_notifikasi'  => 'pembayaran_berhasil',

            'judul_notifikasi'  => 'Konfirmasi Pembayaran Telah Berhasil',

            'pesan_notifikasi'  =>
                'Pembayaran untuk pesanan ' .
                $pembayaran_lama->kode_pesanan .
                ' telah berhasil diverifikasi oleh kasir. Kwitansi pembayaran sudah tersedia dan dapat dicetak.',

            'status_baca'       => 'belum_dibaca'
        ]);
    }

    if(
        $status_pembayaran == 'ditolak'
        &&
        $pembayaran_lama->status_pembayaran != 'ditolak'
    ){

        $this->pembayaran_pakaian_jadi_model->update_pesanan(
            $pembayaran_lama->id_pesanan,
            [
                'status_pesanan' => 'pending'
            ]
        );

        $this->pembayaran_pakaian_jadi_model->insert_notifikasi([
            'id_customer'       => $pembayaran_lama->id_customer,
            'id_pesanan'        => $pembayaran_lama->id_pesanan,
            'id_pembayaran'     => $id_pembayaran,
            'id_request'        => NULL,
            'target_role'       => 'customer',
            'jenis_notifikasi'  => 'pembayaran_ditolak',
            'judul_notifikasi'  => 'Pembayaran Ditolak',
            'pesan_notifikasi'  =>
                'Bukti pembayaran untuk pesanan ' .
                $pembayaran_lama->kode_pesanan .
                ' tidak dapat diverifikasi. Silakan upload ulang bukti pembayaran.',
            'status_baca'       => 'belum_dibaca'
        ]);
    }
    $this->session->set_flashdata(
        'success',
        'Status pembayaran berhasil diperbarui.'
    );
    redirect('kasir/pembayaran-pakaian-jadi');
    }

    public function cetak_kwitansi($id_pembayaran)
    {
        $data['kwitansi'] =
            $this->pembayaran_pakaian_jadi_model->get_kwitansi($id_pembayaran);

        if(!$data['kwitansi']){
            show_404();
        }

        $data['nama_kasir'] =
            $this->session->userdata('nama_user') ?? 'Kasir Lavéra';

        $this->load->view('kasir/pembayaran/kwitansi_pakaian_jadi', $data);
    }
}