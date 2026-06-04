<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori_custom extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('admin/kategori_custom_model');
        $this->load->model('admin/dashboard_model');

        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'admin'){
            redirect('staff-login');
        }
    }

    public function index()
    {
        $data = $this->admin_data();

        $data['page_title'] = 'Kategori Custom';
        $data['page_subtitle'] = 'Kelola kategori custom outfit yang tersedia di Lavéra.';
        $data['custom'] = $this->kategori_custom_model->get_all();

        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/layouts/topbar', $data);
        $this->load->view('admin/kategori_custom/index', $data);
        $this->load->view('admin/layouts/footer');
    }

    public function simpan()
    {
        $gambar_referensi = $this->upload_gambar('gambar_referensi');
        $gambar_bahan     = $this->upload_gambar('gambar_bahan');

        if($gambar_referensi === false || $gambar_bahan === false){
            redirect('admin/kategori-custom');
        }

        $data = [
            'kategori_custom'     => $this->input->post('kategori_custom', true),
            'deskripsi_referensi' => $this->input->post('deskripsi_referensi', true),
            'gambar_referensi'   => $gambar_referensi,
            'gambar_bahan'       => $gambar_bahan,
            'status_custom'      => $this->input->post('status_custom', true)
        ];

        $this->kategori_custom_model->insert($data);

        $this->session->set_flashdata('success', 'Kategori custom berhasil ditambahkan.');
        redirect('admin/kategori-custom');
    }

    private function upload_gambar($field)
    {
        if(empty($_FILES[$field]['name'])){
            return '';
        }

        $upload_path = FCPATH . 'assets/img/custom/';

        if(!is_dir($upload_path)){
            mkdir($upload_path, 0777, true);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048;
        $config['file_name']     = $field . '_' . time();

        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload($field)){
            return $this->upload->data('file_name');
        }

        $this->session->set_flashdata('error', $this->upload->display_errors());
        return false;
    }

    private function admin_data()
    {
        $id_user = $this->session->userdata('id_user');

        $data['admin_profile'] =
            $this->dashboard_model->get_admin_profile($id_user);

        return $data;
    }

    public function hapus($id_custom)
    {
        $this->kategori_custom_model->delete($id_custom);

        $this->session->set_flashdata('success', 'Kategori custom berhasil dihapus.');
        redirect('admin/kategori-custom');
    }

    public function update()
    {
        $id_custom = $this->input->post('id_custom', true);
        $custom_lama = $this->kategori_custom_model->get_by_id($id_custom);
        if(!$custom_lama){
            $this->session->set_flashdata('error', 'Data kategori tidak ditemukan.');
            redirect('admin/kategori-custom');
        }
        $data = [
            'kategori_custom'     => $this->input->post('kategori_custom', true),
            'deskripsi_referensi' => $this->input->post('deskripsi_referensi', true),
            'status_custom'       => $this->input->post('status_custom', true)
        ];
        if(!empty($_FILES['gambar_referensi']['name'])){
            $gambar_referensi = $this->upload_gambar('gambar_referensi');
            if($gambar_referensi === false){
                redirect('admin/kategori-custom');
            }

            $data['gambar_referensi'] = $gambar_referensi;
        }

        if(!empty($_FILES['gambar_bahan']['name'])){
            $gambar_bahan = $this->upload_gambar('gambar_bahan');

            if($gambar_bahan === false){
                redirect('admin/kategori-custom');
            }

            $data['gambar_bahan'] = $gambar_bahan;
        }

        $this->kategori_custom_model->update($id_custom, $data);
        $this->session->set_flashdata('success', 'Kategori custom berhasil diperbarui.');
        redirect('admin/kategori-custom');
    }
}