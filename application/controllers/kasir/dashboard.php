<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('kasir/dashboard_kasir_model');

        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'kasir'){
            redirect('staff-login');
        }
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $data['admin_profile'] =
            $this->dashboard_kasir_model->get_kasir_profile($id_user);

        $data['page_title'] = 'Dashboard Kasir';
        $data['page_subtitle'] = 'Kelola pembayaran, bukti pembayaran, dan transaksi Lavéra.';

        $data['menunggu_verifikasi'] =
            $this->dashboard_kasir_model->menunggu_verifikasi();

        $data['pembayaran_hari_ini'] =
            $this->dashboard_kasir_model->pembayaran_hari_ini();

        $data['pendapatan_hari_ini'] =
            $this->dashboard_kasir_model->pendapatan_hari_ini();

        $data['grafik_pembayaran'] =
            $this->dashboard_kasir_model->grafik_pembayaran();

        $data['notifikasi'] =
            $this->dashboard_kasir_model->get_notifikasi_kasir();

        $this->load->view('kasir/layouts/header');
        $this->load->view('kasir/layouts/sidebar');
        $this->load->view('kasir/layouts/topbar', $data);
        $this->load->view('kasir/dashboard', $data);
        $this->load->view('kasir/layouts/footer');
    }
}