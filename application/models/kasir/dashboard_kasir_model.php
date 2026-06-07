<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_kasir_model extends CI_Model {

    public function get_kasir_profile($id_user)
    {
        return $this->db
            ->where('id_user', $id_user)
            ->get('tbl_users')
            ->row();
    }

   public function menunggu_verifikasi()
    {
        return $this->db
            ->where('status_pembayaran', 'menunggu_verifikasi')
            ->count_all_results('tbl_pembayaran');
    }

    public function pembayaran_hari_ini()
    {
        return $this->db
            ->where('status_pembayaran', 'berhasil')
            ->where('DATE(tanggal_pembayaran)', date('Y-m-d'))
            ->count_all_results('tbl_pembayaran');
    }

    public function pendapatan_hari_ini()
    {
        $this->db->select_sum('jumlah_bayar');
        $this->db->where('status_pembayaran', 'berhasil');
        $this->db->where('DATE(tanggal_pembayaran)', date('Y-m-d'));

        $result = $this->db->get('tbl_pembayaran')->row();

        return $result->jumlah_bayar ?? 0;
    }
    
    public function grafik_pembayaran()
    {
        return $this->db
            ->select('DATE(tanggal_pembayaran) as tanggal, SUM(jumlah_bayar) as total')
            ->where('status_pembayaran', 'berhasil')
            ->where('tanggal_pembayaran IS NOT NULL', null, false)
            ->group_by('DATE(tanggal_pembayaran)')
            ->order_by('tanggal', 'ASC')
            ->get('tbl_pembayaran')
            ->result();
    }

   public function get_notifikasi_kasir()
    {
        return $this->db
            ->where('target_role', 'kasir')
            ->where('status_baca', 'belum_dibaca')
            ->order_by('created_at', 'DESC')
            ->limit(5)
            ->get('tbl_notifikasi')
            ->result();
    }
}