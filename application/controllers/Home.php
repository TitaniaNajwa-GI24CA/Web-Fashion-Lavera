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
        $this->load->model('admin/kategori_custom_model');
        $produk = $this->produk_pakaian_jadi_model->get_produk_group();
        foreach($produk as $p){
            $p->ukuran_stok = $this->produk_pakaian_jadi_model
                ->get_ukuran_stok_by_produk($p->nama_pakaian);
        }
        $data['cart_items'] = [];
        $data['jumlah_cart'] = 0;

        if(!empty($data['customer'])){
            $this->load->model('Cart_model');

            $data['cart_items'] =
                $this->Cart_model->get_cart($data['customer']->id_customer);

            $data['jumlah_cart'] =
                count($data['cart_items']);
        }
        $data['produk'] = $produk;
        $data['custom_db'] = $this->kategori_custom_model->get_custom_admin_aktif();
        $data['riwayat_pakaian'] = [];
        $data['riwayat_custom'] = [];
            if(
                $this->session->userdata('login') &&
                $this->session->userdata('role') == 'customer'
            ){

                $id_user = $this->session->userdata('id_user');

                $this->load->model('Pesanan_model');

                $data['riwayat_pakaian'] =
                    $this->Pesanan_model->get_riwayat_pakaian_jadi($id_user);

                $data['riwayat_custom'] =
                    $this->Pesanan_model->get_riwayat_custom($id_user);
                    
                $data['notifikasi'] = [];
                $data['jumlah_notifikasi'] = 0;

                if(
                    $this->session->userdata('login') &&
                    $this->session->userdata('role') == 'customer' &&
                    !empty($data['customer'])
                ){
                    $id_customer = $data['customer']->id_customer;

                    $data['notifikasi'] = $this->db
                        ->where('id_customer', $id_customer)
                        ->where('target_role', 'customer')
                        ->order_by('id_notifikasi', 'DESC')
                        ->limit(5)
                        ->get('tbl_notifikasi')
                        ->result();

                    $data['jumlah_notifikasi'] = $this->db
                        ->where('id_customer', $id_customer)
                        ->where('target_role', 'customer')
                        ->where('status_baca', 'belum_dibaca')
                        ->count_all_results('tbl_notifikasi');
                }
            }
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