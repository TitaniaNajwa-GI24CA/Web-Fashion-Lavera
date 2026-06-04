<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pesanan_pakaian_jadi_model extends CI_Model {

    public function get_all()
    {
        $this->db->select('
            tbl_pesanan.*,
            tbl_detail_pesanan.jumlah,
            tbl_detail_pesanan.harga,
            tbl_detail_pesanan.subtotal,
            tbl_pakaian_jadi.nama_pakaian,
            tbl_pakaian_jadi.ukuran,
            tbl_pakaian_jadi.foto_4,
            tbl_users.nama_user,
            tbl_users.no_telepon,
            tbl_pembayaran.status_pembayaran
        ');

        $this->db->from('tbl_pesanan');
        $this->db->join(
            'tbl_detail_pesanan',
            'tbl_detail_pesanan.id_pesanan = tbl_pesanan.id_pesanan'
        );
        $this->db->join(
            'tbl_pakaian_jadi',
            'tbl_pakaian_jadi.id_pakaian_jadi = tbl_detail_pesanan.id_pakaian_jadi'
        );
        $this->db->join(
            'tbl_customer',
            'tbl_customer.id_customer = tbl_pesanan.id_customer'
        );
        $this->db->join(
            'tbl_users',
            'tbl_users.id_user = tbl_customer.id_user'
        );
        $this->db->join(
            'tbl_pembayaran',
            'tbl_pembayaran.id_pesanan = tbl_pesanan.id_pesanan',
            'left'
        );
        $this->db->where(
            'tbl_pesanan.tipe_pesanan',
            'pakaian_jadi'
        );
        $this->db->order_by(
            'tbl_pesanan.id_pesanan',
            'DESC'
        );
        return $this->db->get()->result();
    }

    public function update_status($id_pesanan, $data)
    {
        return $this->db
            ->where('id_pesanan', $id_pesanan)
            ->update('tbl_pesanan', $data);
    }
}