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

    public function insert_pembayaran($data)
    {
        return $this->db->insert('tbl_pembayaran', $data);
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
        $this->db->join('tbl_gambar_request','tbl_gambar_request.id_request = tbl_pesanan.id_request','left');
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
            tbl_pakaian_jadi.foto_4,
            tbl_gambar_request.gambar_desain
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

        $this->db->join(
            'tbl_gambar_request',
            'tbl_gambar_request.id_request = tbl_pesanan.id_request',
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
        return $this->db
            ->select('
                tbl_pesanan.*,
                tbl_customer.id_customer,
                tbl_users.nama_user,
                tbl_users.no_telepon
            ')
            ->from('tbl_pesanan')
            ->join('tbl_customer', 'tbl_customer.id_customer = tbl_pesanan.id_customer')
            ->join('tbl_users', 'tbl_users.id_user = tbl_customer.id_user')
            ->where('tbl_pesanan.id_pesanan', $id_pesanan)
            ->where('tbl_customer.id_user', $id_user)
            ->get()
            ->row();
    }

    public function update_pembayaran_by_pesanan($id_pesanan, $data)
    {
        return $this->db
            ->where('id_pesanan', $id_pesanan)
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

    public function get_detail_produk_pesanan($id_pesanan)
    {
        $this->db->select('
            tbl_detail_pesanan.*,
            tbl_pakaian_jadi.nama_pakaian,
            tbl_pakaian_jadi.ukuran,
            tbl_pakaian_jadi.foto_4,
            tbl_gambar_request.gambar_desain
        ');
        $this->db->from('tbl_detail_pesanan');
        $this->db->join('tbl_pakaian_jadi', 'tbl_pakaian_jadi.id_pakaian_jadi = tbl_detail_pesanan.id_pakaian_jadi', 'left');
        $this->db->join('tbl_gambar_request', 'tbl_gambar_request.id_request = tbl_detail_pesanan.id_request', 'left');
        $this->db->where('tbl_detail_pesanan.id_pesanan', $id_pesanan);

        return $this->db->get()->result();
    }

    public function get_detail_custom($id_pesanan, $id_user)
    {
        return $this->db
            ->select('
                tbl_pesanan.*,

                tbl_request_custom.detail_custom,
                tbl_request_custom.estimasi_harga,
                tbl_request_custom.diskon_custom,
                tbl_request_custom.uang_muka,
                tbl_request_custom.status_request,
                tbl_request_custom.tanggal_request,

                tbl_custom.kategori_custom,

                tbl_gambar_request.gambar_desain,

                tbl_users.nama_user,
                tbl_users.no_telepon,
                tbl_users.email,

                tbl_customer.alamat,

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
            ->where('tbl_customer.id_user', $id_user)
            ->where('tbl_pesanan.tipe_pesanan', 'custom')
            ->get()
            ->row();
    }
}