<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_pakaian_jadi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('admin/pesanan_pakaian_jadi_model');
        $this->load->model('admin/Dashboard_model', 'dashboard_model');

        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'admin'){
            redirect('staff-login');
        }
    }

    public function index()
    {
        $data = $this->admin_data();

        $data['page_title'] = 'Pesanan Pakaian Jadi';
        $data['page_subtitle'] = 'Kelola pesanan pakaian jadi dari customer Lavéra.';
        $data['pesanan'] = $this->pesanan_pakaian_jadi_model->get_all();

        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/layouts/topbar', $data);
        $this->load->view('admin/pesanan/pesanan_pakaian_jadi', $data);
        $this->load->view('admin/layouts/footer');
    }

    public function update_status()
    {
        $id_pesanan = $this->input->post('id_pesanan', true);

        $data = [
            'status_pesanan' => $this->input->post('status_pesanan', true)
        ];

        $this->pesanan_pakaian_jadi_model->update_status($id_pesanan, $data);

        $this->session->set_flashdata('success', 'Status pesanan berhasil diperbarui.');
        redirect('admin/pesanan-pakaian-jadi');
    }

    private function admin_data()
    {
        $id_user = $this->session->userdata('id_user');

        $data['admin_profile'] =
            $this->dashboard_model->get_admin_profile($id_user);

        return $data;
    }
}