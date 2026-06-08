<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

    public function get_customer_by_user($id_user)
    {
        return $this->db
            ->where('id_user', $id_user)
            ->get('tbl_customer')
            ->row();
    }

    public function cek_produk($id_customer, $id_pakaian_jadi)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->where('id_pakaian_jadi', $id_pakaian_jadi)
            ->get('tbl_keranjang')
            ->row();
    }

    public function insert_cart($data)
    {
        return $this->db->insert('tbl_keranjang', $data);
    }

    public function tambah_jumlah($id_keranjang)
    {
        return $this->db
            ->set('jumlah', 'jumlah + 1', false)
            ->where('id_keranjang', $id_keranjang)
            ->update('tbl_keranjang');
    }

    public function get_cart($id_customer)
    {
        return $this->db
            ->select('
                tbl_keranjang.*,
                tbl_pakaian_jadi.nama_pakaian,
                tbl_pakaian_jadi.ukuran,
                tbl_pakaian_jadi.harga,
                tbl_pakaian_jadi.diskon_produk,
                tbl_pakaian_jadi.stok,
                tbl_pakaian_jadi.foto_4
            ')
            ->from('tbl_keranjang')
            ->join('tbl_pakaian_jadi', 'tbl_pakaian_jadi.id_pakaian_jadi = tbl_keranjang.id_pakaian_jadi')
            ->where('tbl_keranjang.id_customer', $id_customer)
            ->order_by('tbl_keranjang.id_keranjang', 'DESC')
            ->get()
            ->result();
    }

    public function update_jumlah($id_keranjang, $id_customer, $jumlah)
    {
        return $this->db
            ->where('id_keranjang', $id_keranjang)
            ->where('id_customer', $id_customer)
            ->update('tbl_keranjang', [
                'jumlah' => $jumlah
            ]);
    }

    public function delete_cart($id_keranjang, $id_customer)
    {
        return $this->db
            ->where('id_keranjang', $id_keranjang)
            ->where('id_customer', $id_customer)
            ->delete('tbl_keranjang');
    }

    public function clear_cart($id_customer)
    {
        return $this->db
            ->where('id_customer', $id_customer)
            ->delete('tbl_keranjang');
    }

    public function get_cart_by_id($id_keranjang, $id_customer)
    {
        $this->db->select('tbl_keranjang.*, tbl_pakaian_jadi.stok');
        $this->db->from('tbl_keranjang');
        $this->db->join(
            'tbl_pakaian_jadi',
            'tbl_pakaian_jadi.id_pakaian_jadi = tbl_keranjang.id_pakaian_jadi'
        );
        $this->db->where('tbl_keranjang.id_keranjang', $id_keranjang);
        $this->db->where('tbl_keranjang.id_customer', $id_customer);

        return $this->db->get()->row();
    }
}