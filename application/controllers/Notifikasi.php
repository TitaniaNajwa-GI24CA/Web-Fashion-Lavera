<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notifikasi_model');
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

        $customer = $this->Notifikasi_model->get_customer_by_user($id_user);

        if(!$customer){
            show_404();
        }

        return $customer;
    }

    public function index()
    {
        $customer = $this->get_customer();

        $data['notifikasi'] =
            $this->Notifikasi_model->get_all_customer($customer->id_customer);

        $this->load->view('customer/notifikasi', $data);
    }

    public function detail($id_notifikasi)
    {
        $customer = $this->get_customer();

        $data['notif'] =
            $this->Notifikasi_model->get_detail_customer(
                $id_notifikasi,
                $customer->id_customer
            );

        if(!$data['notif']){
            show_404();
        }

        $this->Notifikasi_model->mark_as_read(
            $id_notifikasi,
            $customer->id_customer
        );

        $this->load->view('customer/notifikasi_detail', $data);
    }
}