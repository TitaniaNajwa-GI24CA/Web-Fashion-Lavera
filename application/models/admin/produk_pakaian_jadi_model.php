<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk_pakaian_jadi_model extends CI_Model {

    public function get_produk_group()
    {
        $this->db->select('
            MIN(id_pakaian_jadi) as id_pakaian_jadi,
            nama_pakaian,
            MIN(detail_model) as detail_model,
            MIN(detail_bahan) as detail_bahan,
            MIN(harga) as harga,
            MIN(diskon_produk) as diskon_produk,
            MIN(foto_1) as foto_1,
            MIN(foto_2) as foto_2,
            MIN(foto_3) as foto_3,
            MIN(foto_4) as foto_4,
            MIN(status_produk) as status_produk
        ');

        $this->db->from('tbl_pakaian_jadi');
        $this->db->where('status_produk', 'Aktif');
        $this->db->group_by('nama_pakaian');
        $this->db->order_by('MIN(id_pakaian_jadi)', 'DESC');

        return $this->db->get()->result();
    }

    public function get_all()
    {
        return $this->db
            ->order_by('id_pakaian_jadi', 'DESC')
            ->get('tbl_pakaian_jadi')
            ->result();
    }

    public function insert($data)
    {
        return $this->db->insert('tbl_pakaian_jadi', $data);
    }

    public function get_ukuran_stok_by_produk($nama_pakaian)
    {
        return $this->db
            ->select('id_pakaian_jadi, ukuran, stok')
            ->where('nama_pakaian', $nama_pakaian)
            ->where('status_produk', 'Aktif')
            ->order_by("FIELD(ukuran, 'S','M','L','XL')")
            ->get('tbl_pakaian_jadi')
            ->result();
    }
}