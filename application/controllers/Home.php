<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

   public function index()
    {
    $data['customer'] = null;
    if($this->session->userdata('login') == TRUE && $this->session->userdata('role') == 'customer') {
        $id_user = $this->session->userdata('id_user');
        $this->db->select('tbl_users.*, tbl_customer.id_customer, tbl_customer.alamat, tbl_customer.foto_profil');
        $this->db->from('tbl_users');
        $this->db->join('tbl_customer', 'tbl_customer.id_user = tbl_users.id_user');
        $this->db->where('tbl_users.id_user', $id_user);
        $data['customer'] = $this->db->get()->row();
    }
        $this->load->model('admin/produk_pakaian_jadi_model');
        $produk = $this->produk_pakaian_jadi_model->get_produk_group();
        foreach($produk as $p){
            $p->ukuran_stok = $this->produk_pakaian_jadi_model
                ->get_ukuran_stok_by_produk($p->nama_pakaian);
        }
        $data['produk'] = $produk;
        $this->load->view('customer/home', $data);
    }

    public function collection()
    {
        $this->load->model('admin/produk_pakaian_jadi_model');
        $produk = $this->produk_pakaian_jadi_model->get_produk_group();
        foreach($produk as $p){
            $p->ukuran_stok = $this->produk_pakaian_jadi_model
                ->get_ukuran_stok_by_produk($p->nama_pakaian);
        }
        $data['produk'] = $produk;
        $this->load->view('customer/collection', $data);
    }

    public function custom_outfit()
    {
        $this->load->view('customer/custom');
    }

    public function custom_formal()
    {
        $this->load->view('customer/custom_formal');
    }

    public function custom_family()
    {
        $this->load->view('customer/custom_family');
    }

    public function custom_occasion()
    {
        $this->load->view('customer/custom_occasion');
    }

    public function custom_casual()
    {
        $this->load->view('customer/custom_casual');
    }

    public function about()
    {
        $this->load->view('customer/about');
    }

    public function contact()
    {
        $this->load->view('customer/contact');
    }
}