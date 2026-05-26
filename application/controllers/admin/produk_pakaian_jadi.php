<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk_pakaian_jadi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/produk_pakaian_jadi_model');
        $this->load->model('admin/dashboard_model');

        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'admin'){
            redirect('staff-login');
        }
    }

    public function index()
    {
        $data = $this->admin_data();
        $data['page_title'] = 'Data Produk Pakaian Jadi';
        $data['page_subtitle'] = 'Kelola semua produk pakaian jadi yang tersedia di Lavéra Fashion.';
        $data['produk'] = $this->produk_pakaian_jadi_model->get_all();
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/layouts/topbar', $data);
        $this->load->view('admin/produk_pakaian_jadi/index', $data);
        $this->load->view('admin/layouts/footer');
    }

    public function tambah()
    {
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/layouts/topbar');
        $this->load->view('admin/produk_pakaian_jadi/tambah');
        $this->load->view('admin/layouts/footer');
    }

    public function simpan()
    {
        $foto = [];

        for($i = 1; $i <= 4; $i++){
            $field = 'foto_'.$i;

            if(!empty($_FILES[$field]['name'])){
                $config['upload_path']   = FCPATH . 'assets/img/produk/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size']      = 2048;
                $config['file_name']     = 'produk_' . $i . '_' . time();

                $this->load->library('upload');
                $this->upload->initialize($config);

                if($this->upload->do_upload($field)){
                    $upload_data = $this->upload->data();
                    $foto[$field] = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/tambah-produk-pakaian-jadi');
                }
            } else {
                $foto[$field] = '';
            }
        }

        $data = [
            'nama_pakaian'   => $this->input->post('nama_pakaian'),
            'detail_model'   => $this->input->post('detail_model'),
            'detail_bahan'   => $this->input->post('detail_bahan'),
            'ukuran'         => $this->input->post('ukuran'),
            'harga'          => $this->input->post('harga'),
            'stok'           => $this->input->post('stok'),
            'diskon_produk'  => $this->input->post('diskon_produk'),
            'foto_1'         => $foto['foto_1'],
            'foto_2'         => $foto['foto_2'],
            'foto_3'         => $foto['foto_3'],
            'foto_4'         => $foto['foto_4'],
            'status_produk'  => $this->input->post('status_produk')
        ];

        $this->produk_pakaian_jadi_model->insert($data);

        $this->session->set_flashdata('success', 'Produk pakaian jadi berhasil ditambahkan.');
        redirect('admin/produk-pakaian-jadi');
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

    private function admin_data()
    {
        $id_user = $this->session->userdata('id_user');
        $data['admin_profile'] = $this->dashboard_model->get_admin_profile($id_user);
        return $data;
    }
}