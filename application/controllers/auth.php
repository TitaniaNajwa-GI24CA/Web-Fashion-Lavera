<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function login()
    {
        $this->load->view('auth/login');
    }

    public function register()
    {
        $this->load->view('auth/register_customer');
    }

    public function proses_register()
    {
        $data_user = [
            'nama_user'   => $this->input->post('nama_user'),
            'username'    => $this->input->post('username'),
            'email'       => $this->input->post('email'),
            'password'    => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role'        => 'customer',
            'no_telepon'  => $this->input->post('no_telepon'),
            'status_akun' => 'aktif'
        ];

        $id_user = $this->auth_model->insert_user($data_user);

        $data_customer = [
            'id_user' => $id_user,
            'alamat'  => $this->input->post('alamat')
        ];

        $this->auth_model->insert_customer($data_customer);

        $this->session->set_flashdata('success', 'Registrasi berhasil, silakan login.');
        redirect('login');
    }

    public function proses_login()
    {
        $login    = $this->input->post('login');
        $password = $this->input->post('password');

        $user = $this->auth_model->get_user_by_login($login);

        if ($user && password_verify($password, $user->password)) {

            if ($user->status_akun != 'aktif') {
                $this->session->set_flashdata('error', 'Akun kamu tidak aktif.');
                redirect('login');
            }
            $session_data = [
                'id_user'   => $user->id_user,
                'nama_user' => $user->nama_user,
                'username'  => $user->username,
                'email'     => $user->email,
                'role'      => $user->role,
                'login'     => TRUE
            ];

            $this->session->set_userdata($session_data);
            $this->session->set_flashdata(
                'success',
                'Selamat datang kembali, '.$user->nama_user.' ✨'
            );

            $this->auth_model->update_last_login($user->id_user);

            if ($user->role == 'admin') {
                redirect('admin/dashboard');
            } elseif ($user->role == 'kasir') {
                redirect('kasir/dashboard');
            } else {
                redirect('home');
            }
        } else {
            $this->session->set_flashdata('error', 'Username/email atau password salah.');
            redirect('login');
        }
    }

    public function update_profile()
    {
        if($this->session->userdata('login') != TRUE) {
            redirect('login');
        }

        $id_user = $this->session->userdata('id_user');

        $data_user = [
            'nama_user'  => $this->input->post('nama_user'),
            'no_telepon' => $this->input->post('no_telepon')
        ];

        $this->db->where('id_user', $id_user);
        $this->db->update('tbl_users', $data_user);

        $data_customer = [
            'alamat' => $this->input->post('alamat')
        ];

        if(!empty($_FILES['foto_profil']['name'])){
            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 2048;
            $config['file_name'] = 'profile_' . time();

            $this->load->library('upload');

            $this->upload->initialize($config);

            if($this->upload->do_upload('foto_profil')){

                $upload_data = $this->upload->data();

                $foto = $upload_data['file_name'];

                $this->db->where('id_user', $id_user);

                $this->db->update('tbl_customer', [
                    'foto_profil' => $foto
                ]);

            } else {

                echo $this->upload->display_errors();
                die();

            }
        }

        $this->db->where('id_user', $id_user);
        $this->db->update('tbl_customer', $data_customer);

        $this->session->set_userdata('nama_user', $this->input->post('nama_user'));
        $this->session->set_flashdata('success', 'Profile berhasil diperbarui.');

        redirect('home');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function forgot_password()
    {
        $email = $this->input->post('email');

        $password_baru = $this->input->post('password_baru');

        $konfirmasi = $this->input->post('konfirmasi_password');

        $user = $this->db
            ->get_where('tbl_users', [
                'email' => $email
            ])
            ->row();

        if(!$user){

            $this->session->set_flashdata(
                'error',
                'Email tidak ditemukan.'
            );

            redirect('login');
        }

        if($password_baru != $konfirmasi){

            $this->session->set_flashdata(
                'error',
                'Konfirmasi password tidak sesuai.'
            );

            redirect('login');
        }

        $password_hash =
        password_hash($password_baru, PASSWORD_DEFAULT);

        $this->db->where('email', $email);

        $this->db->update('tbl_users', [
            'password' => $password_hash
        ]);

        $this->session->set_flashdata(
            'success',
            'Password berhasil diperbarui.'
        );

        redirect('login');
    }
}