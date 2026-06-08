<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_custom extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Request_custom_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    public function form($id_custom)
    {
        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'customer'){
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('login_customer');
        }

        $id_user = $this->session->userdata('id_user');

        $data['customer'] = $this->Request_custom_model->get_customer($id_user);
        $data['custom'] = $this->Request_custom_model->get_custom($id_custom);

        if(!$data['customer'] || !$data['custom']){
            show_404();
        }

        $this->load->view('customer/request_custom_form', $data);
    }

    public function simpan()
    {
        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'customer'){
            redirect('login_customer');
        }

        $id_customer = $this->input->post('id_customer', true);
        $id_custom = $this->input->post('id_custom', true);
        $detail_custom = $this->input->post('detail_custom', true);

        if(empty($id_customer) || empty($id_custom)){
            $this->session->set_flashdata('error', 'Data customer atau kategori custom tidak valid.');
            redirect('custom-outfit');
        }

        if(empty($_FILES['gambar_desain']['name'])){
            $this->session->set_flashdata('error', 'Gambar desain wajib diupload.');
            redirect('request-custom/form/'.$id_custom);
        }

        $upload_path = FCPATH . 'assets/img/request_custom/';

        if(!is_dir($upload_path)){
            mkdir($upload_path, 0777, true);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('gambar_desain')){
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('request-custom/form/'.$id_custom);
        }

        $gambar = $this->upload->data('file_name');

        $this->db->trans_start();

        $data_request = [
            'id_customer'     => $id_customer,
            'id_custom'       => $id_custom,
            'detail_custom'   => $detail_custom,
            'estimasi_harga'  => 0,
            'diskon_custom'   => 0,
            'uang_muka'       => 0,
            'status_request'  => 'Pending'
        ];

        $id_request = $this->Request_custom_model->insert_request($data_request);

        $this->Request_custom_model->insert_gambar_request([
            'id_request'     => $id_request,
            'gambar_desain'  => $gambar
        ]);

        $customer = $this->Request_custom_model->get_customer_by_id($id_customer);
        $custom = $this->Request_custom_model->get_custom($id_custom);

        $this->Request_custom_model->insert_notifikasi([
            'id_customer'       => $id_customer,
            'id_pesanan'        => NULL,
            'id_pembayaran'     => NULL,
            'id_request'        => $id_request,
            'target_role'       => 'admin',
            'jenis_notifikasi'  => 'konfirmasi_request',
            'judul_notifikasi'  => 'Request Custom Baru',
            'pesan_notifikasi'  => $customer->nama_user . ' mengirim request custom untuk kategori ' . $custom->kategori_custom . '.',
            'status_baca'       => 'belum_dibaca'
        ]);

        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            echo '<pre>';
            print_r($this->db->error());
            echo '</pre>';
            die;
        }

        $this->session->set_flashdata('success', 'Request custom berhasil dikirim. Silakan tunggu konfirmasi dari admin.');
        redirect('riwayat-pesanan');
    }
}