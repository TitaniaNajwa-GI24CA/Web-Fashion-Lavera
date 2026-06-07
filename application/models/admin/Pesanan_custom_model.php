<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_custom_model extends CI_Model {

    public function get_all()
    {
        return $this->db
            ->select('
                tbl_pesanan.*,
                tbl_request_custom.detail_custom,
                tbl_request_custom.estimasi_harga,
                tbl_request_custom.diskon_custom,
                tbl_request_custom.uang_muka,
                tbl_request_custom.status_request,
                tbl_custom.kategori_custom,
                tbl_users.nama_user,
                tbl_users.no_telepon,
                tbl_customer.id_customer,
                tbl_gambar_request.gambar_desain,
                tbl_pembayaran.status_pembayaran,
                tbl_pembayaran.jenis_pembayaran,
                tbl_pembayaran.metode_pembayaran,
                tbl_pembayaran.jumlah_bayar
            ')
            ->from('tbl_pesanan')
            ->join('tbl_request_custom', 'tbl_request_custom.id_request = tbl_pesanan.id_request')
            ->join('tbl_custom', 'tbl_custom.id_custom = tbl_request_custom.id_custom')
            ->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer')
            ->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user')
            ->join('tbl_gambar_request', 'tbl_gambar_request.id_request = tbl_request_custom.id_request', 'left')
            ->join('tbl_pembayaran', 'tbl_pembayaran.id_pesanan = tbl_pesanan.id_pesanan', 'left')
            ->where('tbl_pesanan.tipe_pesanan', 'custom')
            ->order_by('tbl_pesanan.id_pesanan', 'DESC')
            ->get()
            ->result();
    }

    public function update_status($id_pesanan, $data)
    {
        return $this->db
            ->where('id_pesanan', $id_pesanan)
            ->update('tbl_pesanan', $data);
    }

    public function get_detail($id_pesanan)
    {
        return $this->db
            ->select('
                tbl_pesanan.*,
                tbl_request_custom.*,
                tbl_custom.kategori_custom,
                tbl_users.nama_user,
                tbl_users.no_telepon,
                tbl_users.email,
                tbl_customer.alamat,
                tbl_gambar_request.gambar_desain,
                tbl_pembayaran.kode_pembayaran,
                tbl_pembayaran.jenis_pembayaran,
                tbl_pembayaran.metode_pembayaran,
                tbl_pembayaran.jumlah_bayar,
                tbl_pembayaran.status_pembayaran,
                tbl_pembayaran.bukti_pembayaran
            ')
            ->from('tbl_pesanan')
            ->join('tbl_request_custom', 'tbl_request_custom.id_request = tbl_pesanan.id_request')
            ->join('tbl_custom', 'tbl_custom.id_custom = tbl_request_custom.id_custom')
            ->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer')
            ->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user')
            ->join('tbl_gambar_request', 'tbl_gambar_request.id_request = tbl_request_custom.id_request', 'left')
            ->join('tbl_pembayaran', 'tbl_pembayaran.id_pesanan = tbl_pesanan.id_pesanan', 'left')
            ->where('tbl_pesanan.id_pesanan', $id_pesanan)
            ->get()
            ->row();
    }
}