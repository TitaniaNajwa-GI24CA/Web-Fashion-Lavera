<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pembayaran_pakaian_jadi_model extends CI_Model {
    public function get_all()
    {
        return $this->db
            ->select('
                tbl_pembayaran.*,
                tbl_pesanan.kode_pesanan,
                tbl_pesanan.total_bayar,
                tbl_pesanan.status_pesanan,
                tbl_pesanan.tipe_pesanan,
                tbl_users.nama_user,
                tbl_users.no_telepon,
                tbl_customer.id_customer,
                tbl_pakaian_jadi.nama_pakaian,
                tbl_pakaian_jadi.ukuran,
                tbl_pakaian_jadi.foto_1,
                tbl_detail_pesanan.jumlah
            ')
            ->from('tbl_pembayaran')
            ->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_pembayaran.id_pesanan')
            ->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer')
            ->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user')
            ->join('tbl_detail_pesanan', 'tbl_detail_pesanan.id_pesanan = tbl_pesanan.id_pesanan')
            ->join('tbl_pakaian_jadi', 'tbl_pakaian_jadi.id_pakaian_jadi = tbl_detail_pesanan.id_pakaian_jadi')
            ->where('tbl_pesanan.tipe_pesanan', 'pakaian_jadi')
            ->order_by('tbl_pembayaran.id_pembayaran', 'DESC')
            ->get()
            ->result();
    }

    public function get_pesanan_belum_cash()
    {
        return $this->db
            ->select('
                tbl_pesanan.id_pesanan,
                tbl_pesanan.kode_pesanan,
                tbl_pesanan.total_bayar,
                tbl_users.nama_user
            ')
            ->from('tbl_pesanan')
            ->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer')
            ->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user')
            ->join('tbl_pembayaran', 'tbl_pembayaran.id_pesanan = tbl_pesanan.id_pesanan', 'left')
            ->where('tbl_pesanan.tipe_pesanan', 'pakaian_jadi')
            ->where('tbl_pesanan.metode_pembayaran', 'cash')
            ->where('tbl_pembayaran.id_pembayaran IS NULL', null, false)
            ->get()
            ->result();
    }

    public function insert($data)
    {
        return $this->db->insert('tbl_pembayaran', $data);
    }

    public function get_by_id($id_pembayaran)
    {
        return $this->db
            ->select('
                tbl_pembayaran.*,
                tbl_pesanan.id_customer,
                tbl_pesanan.kode_pesanan
            ')
            ->from('tbl_pembayaran')
            ->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_pembayaran.id_pesanan')
            ->where('tbl_pembayaran.id_pembayaran', $id_pembayaran)
            ->get()
            ->row();
    }

    public function update($id_pembayaran, $data)
    {
        return $this->db
            ->where('id_pembayaran', $id_pembayaran)
            ->update('tbl_pembayaran', $data);
    }

    public function update_pesanan($id_pesanan, $data)
    {
        return $this->db
            ->where('id_pesanan', $id_pesanan)
            ->update('tbl_pesanan', $data);
    }

    public function insert_notifikasi($data)
    {
        return $this->db->insert('tbl_notifikasi', $data);
    }
}