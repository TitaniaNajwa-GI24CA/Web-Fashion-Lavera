<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pesanan_model extends CI_Model {

    public function get_produk($id_pakaian_jadi)
    {
        return $this->db
            ->where('id_pakaian_jadi', $id_pakaian_jadi)
            ->where('status_produk', 'Aktif')
            ->get('tbl_pakaian_jadi')
            ->row();
    }

    public function get_customer_by_user($id_user)
    {
        $this->db->select('
            tbl_users.id_user,
            tbl_users.nama_user,
            tbl_users.no_telepon,
            tbl_customer.id_customer,
            tbl_customer.alamat
        ');
        $this->db->from('tbl_users');
        $this->db->join('tbl_customer', 'tbl_customer.id_user = tbl_users.id_user', 'left');
        $this->db->where('tbl_users.id_user', $id_user);

        return $this->db->get()->row();
    }

    public function insert_pesanan($data)
    {
        $this->db->insert('tbl_pesanan', $data);
        return $this->db->insert_id();
    }

    public function insert_detail_pesanan($data)
    {
        return $this->db->insert('tbl_detail_pesanan', $data);
    }

    public function get_riwayat_pakaian_jadi($id_user)
    {
        $this->db->select('tbl_pesanan.*');
        $this->db->from('tbl_pesanan');
        $this->db->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer');
        $this->db->where('tbl_customer.id_user', $id_user);
        $this->db->where('tbl_pesanan.tipe_pesanan', 'pakaian_jadi');
        $this->db->order_by('tbl_pesanan.tanggal_pesanan', 'DESC');

        return $this->db->get()->result();
    }

    public function get_riwayat_custom($id_user)
    {
        $this->db->select('tbl_pesanan.*');
        $this->db->from('tbl_pesanan');
        $this->db->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer');
        $this->db->where('tbl_customer.id_user', $id_user);
        $this->db->where('tbl_pesanan.tipe_pesanan', 'custom');
        $this->db->order_by('tbl_pesanan.tanggal_pesanan', 'DESC');

        return $this->db->get()->result();
    }

   public function get_riwayat_all($id_user)
    {
        $this->db->select('
            tbl_pesanan.*,
            tbl_pakaian_jadi.nama_pakaian,
            tbl_pakaian_jadi.foto_1
        ');

        $this->db->from('tbl_pesanan');

        $this->db->join(
            'tbl_customer',
            'tbl_customer.id_customer = tbl_pesanan.id_customer'
        );

        $this->db->join(
            'tbl_detail_pesanan',
            'tbl_detail_pesanan.id_pesanan = tbl_pesanan.id_pesanan',
            'left'
        );

        $this->db->join(
            'tbl_pakaian_jadi',
            'tbl_pakaian_jadi.id_pakaian_jadi = tbl_detail_pesanan.id_pakaian_jadi',
            'left'
        );

        $this->db->where(
            'tbl_customer.id_user',
            $id_user
        );

        $this->db->order_by(
            'tbl_pesanan.id_pesanan',
            'DESC'
        );

        return $this->db->get()->result();
    }

    public function get_detail_riwayat($id_pesanan, $id_user)
    {
        $this->db->select('
            tbl_pesanan.*,
            tbl_customer.alamat,
            tbl_users.nama_user,
            tbl_users.no_telepon
        ');
        $this->db->from('tbl_pesanan');
        $this->db->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer');
        $this->db->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user');
        $this->db->where('tbl_pesanan.id_pesanan', $id_pesanan);
        $this->db->where('tbl_customer.id_user', $id_user);

        return $this->db->get()->row();
    }

    public function get_detail_produk_pesanan($id_pesanan)
    {
        $this->db->select('
            tbl_detail_pesanan.*,
            tbl_pakaian_jadi.nama_pakaian,
            tbl_pakaian_jadi.ukuran,
            tbl_pakaian_jadi.foto_1
        ');
        $this->db->from('tbl_detail_pesanan');
        $this->db->join('tbl_pakaian_jadi', 'tbl_pakaian_jadi.id_pakaian_jadi = tbl_detail_pesanan.id_pakaian_jadi', 'left');
        $this->db->where('tbl_detail_pesanan.id_pesanan', $id_pesanan);

        return $this->db->get()->result();
    }
}