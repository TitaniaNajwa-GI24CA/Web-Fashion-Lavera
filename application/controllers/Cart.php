<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model');
        $this->load->library('user_agent');
    }

    private function get_customer()
    {
        if(
            $this->session->userdata('login') != TRUE ||
            $this->session->userdata('role') != 'customer'
        ){
            redirect('login_customer');
        }

        $id_user = $this->session->userdata('id_user');
        $customer = $this->Cart_model->get_customer_by_user($id_user);

        if(!$customer){
            show_404();
        }

        return $customer;
    }

    public function index()
    {
        $customer = $this->get_customer();

        $data['cart_items'] =
            $this->Cart_model->get_cart($customer->id_customer);

        $this->load->view('customer/cart', $data);
    }

    public function add($id_pakaian_jadi)
    {
        $customer = $this->get_customer();

        $cek = $this->Cart_model->cek_produk(
            $customer->id_customer,
            $id_pakaian_jadi
        );

        if($cek){
            $this->Cart_model->tambah_jumlah($cek->id_keranjang);
        }else{
            $this->Cart_model->insert_cart([
                'id_customer'     => $customer->id_customer,
                'id_pakaian_jadi' => $id_pakaian_jadi,
                'jumlah'          => 1
            ]);
        }

        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan ke keranjang.');

        redirect($this->agent->referrer() ?: 'cart');
    }

    public function update()
    {
        $customer = $this->get_customer();

        $id_keranjang = $this->input->post('id_keranjang', true);
        $jumlah = (int) $this->input->post('jumlah', true);

        if($jumlah < 1){
            $jumlah = 1;
        }

        $this->Cart_model->update_jumlah(
            $id_keranjang,
            $customer->id_customer,
            $jumlah
        );

        redirect('cart');
    }

    public function delete($id_keranjang)
    {
        $customer = $this->get_customer();

        $this->Cart_model->delete_cart(
            $id_keranjang,
            $customer->id_customer
        );

        $this->session->set_flashdata('success', 'Produk berhasil dihapus dari keranjang.');
        redirect('cart');
    }

    public function clear()
    {
        $customer = $this->get_customer();

        $this->Cart_model->clear_cart($customer->id_customer);

        $this->session->set_flashdata('success', 'Keranjang berhasil dikosongkan.');
        redirect('cart');
    }

    public function plus($id_keranjang)
{
    $customer = $this->get_customer();

    $cart = $this->Cart_model->get_cart_by_id(
        $id_keranjang,
        $customer->id_customer
    );

    if(!$cart){
        show_404();
    }

    $jumlah_baru = $cart->jumlah + 1;

    if($jumlah_baru > $cart->stok){
        $jumlah_baru = $cart->stok;
    }

    $this->Cart_model->update_jumlah(
        $id_keranjang,
        $customer->id_customer,
        $jumlah_baru
    );

    redirect('cart');
}

    public function minus($id_keranjang)
    {
        $customer = $this->get_customer();

        $cart = $this->Cart_model->get_cart_by_id(
            $id_keranjang,
            $customer->id_customer
        );

        if(!$cart){
            show_404();
        }

        $jumlah_baru = $cart->jumlah - 1;

        if($jumlah_baru < 1){
            $jumlah_baru = 1;
        }

        $this->Cart_model->update_jumlah(
            $id_keranjang,
            $customer->id_customer,
            $jumlah_baru
        );

        redirect('cart');
    }
}