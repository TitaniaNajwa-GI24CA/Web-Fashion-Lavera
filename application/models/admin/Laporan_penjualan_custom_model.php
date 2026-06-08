<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_penjualan_custom_model extends CI_Model {

    public function get_laporan($bulan = null, $tahun = null)
    {
        $this->db->select('
            tbl_pembayaran.kode_pembayaran,
            tbl_pembayaran.tanggal_pembayaran,
            tbl_pembayaran.metode_pembayaran,
            tbl_pembayaran.jumlah_bayar,

            tbl_pesanan.kode_pesanan,
            tbl_pesanan.total_bayar,

            tbl_request_custom.estimasi_harga,
            tbl_request_custom.uang_muka,
            tbl_request_custom.diskon_custom,

            tbl_custom.kategori_custom,

            tbl_users.nama_user
        ');

        $this->db->from('tbl_pembayaran');
        $this->db->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_pembayaran.id_pesanan');
        $this->db->join('tbl_request_custom', 'tbl_request_custom.id_request = tbl_pesanan.id_request');
        $this->db->join('tbl_custom', 'tbl_custom.id_custom = tbl_request_custom.id_custom');
        $this->db->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer');
        $this->db->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user');

        $this->db->where('tbl_pesanan.tipe_pesanan', 'custom');
        $this->db->where('tbl_pembayaran.jenis_pembayaran', 'pelunasan_custom');
        $this->db->where('tbl_pembayaran.status_pembayaran', 'berhasil');

        if(!empty($bulan)){
            $this->db->where('MONTH(tbl_pembayaran.tanggal_pembayaran)', $bulan);
        }

        if(!empty($tahun)){
            $this->db->where('YEAR(tbl_pembayaran.tanggal_pembayaran)', $tahun);
        }

        $this->db->order_by('tbl_pembayaran.tanggal_pembayaran', 'DESC');

        return $this->db->get()->result();
    }

    public function total_pendapatan($bulan = null, $tahun = null)
    {
        $this->db->select_sum('tbl_request_custom.estimasi_harga');
        $this->db->from('tbl_pembayaran');
        $this->db->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_pembayaran.id_pesanan');
        $this->db->join('tbl_request_custom', 'tbl_request_custom.id_request = tbl_pesanan.id_request');

        $this->db->where('tbl_pesanan.tipe_pesanan', 'custom');
        $this->db->where('tbl_pembayaran.jenis_pembayaran', 'pelunasan_custom');
        $this->db->where('tbl_pembayaran.status_pembayaran', 'berhasil');

        if(!empty($bulan)){
            $this->db->where('MONTH(tbl_pembayaran.tanggal_pembayaran)', $bulan);
        }

        if(!empty($tahun)){
            $this->db->where('YEAR(tbl_pembayaran.tanggal_pembayaran)', $tahun);
        }

        $result = $this->db->get()->row();

        return $result->estimasi_harga ?? 0;
    }
}