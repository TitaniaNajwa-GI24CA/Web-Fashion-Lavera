<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/dashboard_model');

        if ($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'admin') {
            redirect('staff-login');
        }
    }

    public function index()
    {
        $data['page_title'] = 'Dashboard';
        $data['page_subtitle'] = 'Selamat datang kembali, '.$this->session->userdata('nama_user').' ✨';
        $id_user = $this->session->userdata('id_user');
        $data['admin_profile'] = $this->dashboard_model->get_admin_profile($id_user);
        $data['total_pesanan']      = $this->dashboard_model->total_pesanan();
        $data['request_custom']     = $this->dashboard_model->total_request_custom();
        $data['pendapatan']         = $this->dashboard_model->total_pendapatan();
        $data['notifikasi']         = $this->dashboard_model->notifikasi_terbaru();
        $data['grafik_penjualan']   = $this->dashboard_model->grafik_penjualan();

        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/layouts/topbar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/layouts/footer');
    }

    public function update_profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data_user = [
            'nama_user'  => $this->input->post('nama_user'),
            'username'   => $this->input->post('username'),
            'email'      => $this->input->post('email'),
            'no_telepon' => $this->input->post('no_telepon')
        ];

        $this->db->where('id_user', $id_user);
        $this->db->update('tbl_users', $data_user);

        if(!empty($_FILES['foto_profil']['name'])){

            $config['upload_path']   = FCPATH . 'assets/img/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['file_name']     = 'admin_' . $id_user . '_' . time();

            $this->load->library('upload');
            $this->upload->initialize($config);

            if($this->upload->do_upload('foto_profil')){

                $upload_data = $this->upload->data();
                $foto_baru = $upload_data['file_name'];

                $cek_admin = $this->db
                    ->get_where('tbl_admin', ['id_user' => $id_user])
                    ->row();

                if($cek_admin){
                    $this->db->where('id_user', $id_user);
                    $this->db->update('tbl_admin', [
                        'foto_profil' => $foto_baru
                    ]);
                } else {
                    $this->db->insert('tbl_admin', [
                        'id_user' => $id_user,
                        'foto_profil' => $foto_baru
                    ]);
                }

            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/dashboard');
            }
        }

        $this->session->set_userdata('nama_user', $this->input->post('nama_user'));

        $this->session->set_flashdata(
            'success',
            'Profile berhasil diperbarui ✨'
        );

        redirect('admin/dashboard');
    }
}