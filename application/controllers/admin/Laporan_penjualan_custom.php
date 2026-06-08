<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_penjualan_custom extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('admin/Laporan_penjualan_custom_model');
        $this->load->model('admin/Dashboard_model', 'dashboard_model');

        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'admin'){
            redirect('staff-login');
        }
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $bulan = $this->input->get('bulan', true);
        $tahun = $this->input->get('tahun', true);

        $data['admin_profile'] =
            $this->dashboard_model->get_admin_profile($id_user);

        $data['page_title'] = 'Laporan Penjualan Custom';
        $data['page_subtitle'] = 'Laporan pesanan custom yang sudah selesai pelunasan.';

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $data['laporan'] =
            $this->Laporan_penjualan_custom_model->get_laporan($bulan, $tahun);

        $data['total_pendapatan'] =
            $this->Laporan_penjualan_custom_model->total_pendapatan($bulan, $tahun);

        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/layouts/topbar', $data);
        $this->load->view('admin/laporan/laporan_custom', $data);
        $this->load->view('admin/layouts/footer');
    }

    public function download_pdf()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        $data['laporan'] =
            $this->Laporan_penjualan_custom_model
                ->get_laporan($bulan,$tahun);

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->load->view(
            'admin/laporan/pdf_custom',
            $data
        );
    }

    public function download_excel()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        $data['laporan'] =
            $this->Laporan_penjualan_custom_model
                ->get_laporan($bulan,$tahun);

        $this->load->view(
            'admin/laporan/excel_custom',
            $data
        );
    }
}