<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_custom_model extends CI_Model {

    public function get_all()
    {
        return $this->db
            ->select('
                tbl_request_custom.*,
                tbl_custom.kategori_custom,
                tbl_custom.gambar_referensi,
                tbl_users.nama_user,
                tbl_users.no_telepon,
                tbl_customer.id_customer,
                tbl_gambar_request.gambar_desain,
                (
                    SELECT COUNT(*)
                    FROM tbl_request_custom rc
                    WHERE rc.id_customer = tbl_request_custom.id_customer
                ) AS total_request_customer
            ')
            ->from('tbl_request_custom')
            ->join('tbl_customer', 'tbl_customer.id_customer = tbl_request_custom.id_customer')
            ->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user')
            ->join('tbl_custom', 'tbl_custom.id_custom = tbl_request_custom.id_custom')
            ->join('tbl_gambar_request', 'tbl_gambar_request.id_request = tbl_request_custom.id_request', 'left')
            ->order_by('tbl_request_custom.id_request', 'DESC')
            ->get()
            ->result();
    }

    public function get_by_id($id_request)
    {
        return $this->db
            ->select('
                tbl_request_custom.*,
                tbl_custom.kategori_custom,
                tbl_users.nama_user,
                tbl_customer.id_customer
            ')
            ->from('tbl_request_custom')
            ->join('tbl_customer', 'tbl_customer.id_customer = tbl_request_custom.id_customer')
            ->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user')
            ->join('tbl_custom', 'tbl_custom.id_custom = tbl_request_custom.id_custom')
            ->where('tbl_request_custom.id_request', $id_request)
            ->get()
            ->row();
    }

    public function update($id_request, $data)
    {
        return $this->db
            ->where('id_request', $id_request)
            ->update('tbl_request_custom', $data);
    }

    public function insert_notifikasi($data)
    {
        return $this->db->insert('tbl_notifikasi', $data);
    }

    public function insert_pesanan($data)
    {
        $this->db->insert('tbl_pesanan', $data);
        return $this->db->insert_id();
    }

    public function insert_pembayaran($data)
    {
        return $this->db->insert('tbl_pembayaran', $data);
    }

    public function cek_pesanan_request($id_request)
    {
        return $this->db
            ->where('id_request', $id_request)
            ->get('tbl_pesanan')
            ->row();
    }
}