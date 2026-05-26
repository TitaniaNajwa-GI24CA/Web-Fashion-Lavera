<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_model extends CI_Model {

    public function total_pesanan()
    {
        return $this->db->count_all('tbl_pesanan');
    }

    public function total_request_custom()
    {
        return $this->db->count_all('tbl_request_custom');
    }

    public function total_pendapatan()
    {
        $this->db->select_sum('jumlah_bayar');
        $this->db->where('jenis_pembayaran', 'full_payment');
        $this->db->where('status_pembayaran', 'berhasil');
        $result = $this->db->get('tbl_pembayaran')->row();

        return $result->jumlah_bayar ?? 0;
    }

    public function pesanan_terbaru()
    {
        $this->db->select('tbl_pesanan.*, tbl_users.nama_user');
        $this->db->from('tbl_pesanan');
        $this->db->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer');
        $this->db->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user');
        $this->db->order_by('tbl_pesanan.tanggal_pesanan', 'DESC');
        $this->db->limit(5);

        return $this->db->get()->result();
    }

    public function grafik_penjualan()
    {
        $this->db->select("DATE(tanggal_pembayaran) as tanggal, SUM(jumlah_bayar) as total");
        $this->db->from('tbl_pembayaran');
        $this->db->where('jenis_pembayaran', 'full_payment');
        $this->db->where('status_pembayaran', 'berhasil');
        $this->db->group_by('DATE(tanggal_pembayaran)');
        $this->db->order_by('tanggal', 'ASC');
        $this->db->limit(7);

        return $this->db->get()->result();
    }

    public function notifikasi_terbaru()
    {
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(5);

        return $this->db->get('tbl_notifikasi')->result();
    }

    public function get_admin_profile($id_user)
    {
        $this->db->select('tbl_users.*, tbl_admin.foto_profil');
        $this->db->from('tbl_users');
        $this->db->join('tbl_admin', 'tbl_admin.id_user = tbl_users.id_user', 'left');
        $this->db->where('tbl_users.id_user', $id_user);

        return $this->db->get()->row();
    }

    public function get_produk_pakaian_jadi()
    {
        return $this->db
            ->order_by('created_at', 'DESC')
            ->get('tbl_pakaian_jadi')
            ->result();
    }
}