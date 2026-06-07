<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_custom extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('admin/Request_custom_model');
        $this->load->model('admin/Dashboard_model', 'dashboard_model');

        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'admin'){
            redirect('staff-login');
        }
    }

    public function index()
    {
        $data = $this->admin_data();

        $data['page_title'] = 'Request Custom';
        $data['page_subtitle'] = 'Kelola request custom outfit dari customer Lavéra.';
        $data['request_custom'] = $this->Request_custom_model->get_all();

        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/layouts/topbar', $data);
        $this->load->view('admin/request_custom/index', $data);
        $this->load->view('admin/layouts/footer');
    }

    public function update()
    {
        $id_request = $this->input->post('id_request', true);
        $estimasi_harga = $this->input->post('estimasi_harga', true);
        $uang_muka = round($estimasi_harga * 0.5);
        $request_lama = $this->Request_custom_model->get_by_id($id_request);

        if(!$request_lama){
            show_404();
        }

        $data = [
            'estimasi_harga' => $estimasi_harga,
            'uang_muka'      => $uang_muka,
            'diskon_custom'  => $this->input->post('diskon_custom', true),
            'status_request' => $this->input->post('status_request', true)
        ];

        $this->Request_custom_model->update($id_request, $data);

        if($data['status_request'] == 'Disetujui'){
        $cek_pesanan = $this->Request_custom_model
            ->cek_pesanan_request($id_request);

            if(!$cek_pesanan){

                $kode_pesanan = 'PSN-CUS-' . date('YmdHis');

                $data_pesanan = [
                    'id_customer'        => $request_lama->id_customer,
                    'id_request'         => $id_request,
                    'kode_pesanan'       => $kode_pesanan,
                    'total_bayar'        => $data['estimasi_harga'],
                    'tipe_pesanan'       => 'custom',
                    'status_pesanan'     => 'pending',
                    'metode_pengambilan' => 'delivery',
                    'alamat_pengiriman'  => NULL,
                    'ekspedisi'          => NULL,
                    'metode_pembayaran'  => NULL
                ];

                $id_pesanan = $this->Request_custom_model
                    ->insert_pesanan($data_pesanan);

                $data_pembayaran = [
                    'id_pesanan'         => $id_pesanan,
                    'id_request'         => $id_request,
                    'kode_pembayaran'    => 'BYR-DP-' . date('YmdHis'),
                    'jenis_pembayaran'   => 'uang_muka_custom',
                    'metode_pembayaran'  => NULL,
                    'jumlah_bayar'       => $data['uang_muka'],
                    'bukti_pembayaran'   => NULL,
                    'status_pembayaran'  => 'belum_bayar'
                ];

                $this->Request_custom_model
                    ->insert_pembayaran($data_pembayaran);
            }
        }

        if($request_lama->status_request != $data['status_request']){
            $this->Request_custom_model->insert_notifikasi([
                'id_customer'      => $request_lama->id_customer,
                'id_pesanan'       => NULL,
                'id_pembayaran'    => NULL,
                'id_request'       => $id_request,
                'target_role'      => 'customer',
                'jenis_notifikasi' => 'konfirmasi_request',
                'judul_notifikasi' => 'Konfirmasi Request Custom',
                'pesan_notifikasi' =>
                    'Request custom untuk kategori ' .
                    $request_lama->kategori_custom .
                    ' telah dikonfirmasi admin dengan status ' .
                    $data['status_request'] .
                    '. Silakan cek detail request custom kamu.',
                'status_baca'      => 'belum_dibaca'
            ]);
        }

        $this->session->set_flashdata('success', 'Request custom berhasil diperbarui.');
        redirect('admin/request-custom');
    }

    private function admin_data()
    {
        $id_user = $this->session->userdata('id_user');

        $data['admin_profile'] =
            $this->dashboard_model->get_admin_profile($id_user);

        return $data;
    }
}