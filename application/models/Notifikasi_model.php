<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model {

    public function get_customer_by_user($id_user)
    {
        return $this->db
            ->where('id_user', $id_user)
            ->get('tbl_customer')
            ->row();
    }

    public function get_all_customer($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('target_role', 'customer')
            ->order_by('id_notifikasi', 'DESC')
            ->get('tbl_notifikasi')
            ->result();
    }

    public function get_detail_customer($id_notifikasi, $id_customer)
    {
        return $this->db
            ->select('
                tbl_notifikasi.*,
                tbl_pesanan.kode_pesanan,
                tbl_pesanan.tipe_pesanan,
                tbl_pembayaran.jenis_pembayaran,
                tbl_pembayaran.status_pembayaran
            ')
            ->from('tbl_notifikasi')
            ->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_notifikasi.id_pesanan', 'left')
            ->join('tbl_pembayaran', 'tbl_pembayaran.id_pembayaran = tbl_notifikasi.id_pembayaran', 'left')
            ->where('tbl_notifikasi.id_notifikasi', $id_notifikasi)
            ->where('tbl_notifikasi.id_customer', $id_customer)
            ->where('tbl_notifikasi.target_role', 'customer')
            ->get()
            ->row();
    }

    public function mark_as_read($id_notifikasi, $id_customer)
    {
        return $this->db
            ->where('id_notifikasi', $id_notifikasi)
            ->where('id_customer', $id_customer)
            ->update('tbl_notifikasi', [
                'status_baca' => 'dibaca'
            ]);
    }
    
}