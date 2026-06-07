<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_custom_model extends CI_Model {

    public function get_customer($id_user)
    {
        return $this->db
            ->select('tbl_customer.*, tbl_users.nama_user, tbl_users.no_telepon, tbl_users.email')
            ->from('tbl_customer')
            ->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user')
            ->where('tbl_customer.id_user', $id_user)
            ->get()
            ->row();
    }

    public function get_customer_by_id($id_customer)
    {
        return $this->db
            ->select('tbl_customer.*, tbl_users.nama_user, tbl_users.no_telepon, tbl_users.email')
            ->from('tbl_customer')
            ->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user')
            ->where('tbl_customer.id_customer', $id_customer)
            ->get()
            ->row();
    }

    public function get_custom($id_custom)
    {
        return $this->db
            ->where('id_custom', $id_custom)
            ->get('tbl_custom')
            ->row();
    }

    public function insert_request($data)
    {
        $this->db->insert('tbl_request_custom', $data);
        return $this->db->insert_id();
    }

    public function insert_gambar_request($data)
    {
        return $this->db->insert('tbl_gambar_request', $data);
    }

    public function insert_notifikasi($data)
    {
        return $this->db->insert('tbl_notifikasi', $data);
    }
}