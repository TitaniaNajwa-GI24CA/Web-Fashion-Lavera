<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $this->load->view('customer/home');
    }

    public function collection()
    {
        $this->load->view('customer/collection');
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