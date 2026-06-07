<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelunasan_custom_model extends CI_Model {

    public function get_all()
    {
        return $this->db
            ->select('
                tbl_pembayaran.*,
                tbl_pesanan.kode_pesanan,
                tbl_pesanan.status_pesanan,

                tbl_request_custom.estimasi_harga,
                tbl_request_custom.uang_muka,
                tbl_request_custom.diskon_custom,
                tbl_request_custom.detail_custom,

                tbl_custom.kategori_custom,

                tbl_customer.id_customer,
                tbl_users.nama_user,
                tbl_users.no_telepon,

                tbl_gambar_request.gambar_desain
            ')
            ->from('tbl_pembayaran')
            ->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_pembayaran.id_pesanan')
            ->join('tbl_request_custom', 'tbl_request_custom.id_request = tbl_pembayaran.id_request')
            ->join('tbl_custom', 'tbl_custom.id_custom = tbl_request_custom.id_custom')
            ->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer')
            ->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user')
            ->join('tbl_gambar_request', 'tbl_gambar_request.id_request = tbl_request_custom.id_request', 'left')
            ->where('tbl_pembayaran.jenis_pembayaran', 'pelunasan_custom')
            ->order_by('tbl_pembayaran.id_pembayaran', 'DESC')
            ->get()
            ->result();
    }

    public function get_by_id($id_pembayaran)
    {
        return $this->db
            ->select('
                tbl_pembayaran.*,
                tbl_pesanan.kode_pesanan,
                tbl_pesanan.id_customer,
                tbl_request_custom.estimasi_harga,
                tbl_request_custom.uang_muka
            ')
            ->from('tbl_pembayaran')
            ->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_pembayaran.id_pesanan')
            ->join('tbl_request_custom', 'tbl_request_custom.id_request = tbl_pembayaran.id_request')
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

    public function get_kwitansi($id_pembayaran)
    {
        return $this->db
            ->select('
                tbl_pembayaran.*,
                tbl_pesanan.kode_pesanan,
                tbl_pesanan.tanggal_pesanan,
                tbl_request_custom.estimasi_harga,
                tbl_request_custom.uang_muka,
                tbl_custom.kategori_custom,
                tbl_users.nama_user,
                tbl_users.no_telepon,
                tbl_customer.alamat
            ')
            ->from('tbl_pembayaran')
            ->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_pembayaran.id_pesanan')
            ->join('tbl_request_custom', 'tbl_request_custom.id_request = tbl_pembayaran.id_request')
            ->join('tbl_custom', 'tbl_custom.id_custom = tbl_request_custom.id_custom')
            ->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer')
            ->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user')
            ->where('tbl_pembayaran.id_pembayaran', $id_pembayaran)
            ->where('tbl_pembayaran.jenis_pembayaran', 'pelunasan_custom')
            ->get()
            ->row();
    }
}