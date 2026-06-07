<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelunasan_custom extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('kasir/Pelunasan_custom_model');
        $this->load->model('kasir/Dashboard_kasir_model');

        if($this->session->userdata('login') != TRUE || $this->session->userdata('role') != 'kasir'){
            redirect('staff-login');
        }
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $data['admin_profile'] =
            $this->Dashboard_kasir_model->get_kasir_profile($id_user);

        $data['page_title'] = 'Pelunasan Custom';
        $data['page_subtitle'] = 'Kelola verifikasi pembayaran pelunasan custom outfit.';

        $data['pembayaran'] =
            $this->Pelunasan_custom_model->get_all();

        $this->load->view('kasir/layouts/header');
        $this->load->view('kasir/layouts/sidebar');
        $this->load->view('kasir/layouts/topbar', $data);
        $this->load->view('kasir/pembayaran/pelunasan_custom', $data);
        $this->load->view('kasir/layouts/footer');
    }

    public function update_status()
    {
        $id_pembayaran = $this->input->post('id_pembayaran', true);
        $status_pembayaran = $this->input->post('status_pembayaran', true);

        $pembayaran_lama =
            $this->Pelunasan_custom_model->get_by_id($id_pembayaran);

        if(!$pembayaran_lama){
            show_404();
        }

        $this->Pelunasan_custom_model->update($id_pembayaran, [
            'status_pembayaran' => $status_pembayaran
        ]);

        if($status_pembayaran == 'berhasil' && $pembayaran_lama->status_pembayaran != 'berhasil'){

            $this->Pelunasan_custom_model->update_pesanan(
                $pembayaran_lama->id_pesanan,
                ['status_pesanan' => 'diproduksi']
            );

            $this->Pelunasan_custom_model->insert_notifikasi([
                'id_customer'      => $pembayaran_lama->id_customer,
                'id_pesanan'       => $pembayaran_lama->id_pesanan,
                'id_pembayaran'    => $id_pembayaran,
                'id_request'       => $pembayaran_lama->id_request,
                'target_role'      => 'customer',
                'jenis_notifikasi' => 'pelunasan_berhasil',
                'judul_notifikasi' => 'Pelunasan Custom Berhasil',
                'pesan_notifikasi' =>
                    'Pembayaran pelunasan untuk pesanan ' .
                    $pembayaran_lama->kode_pesanan .
                    ' telah berhasil diverifikasi. Kwitansi sudah dapat dicetak.',
                'status_baca'      => 'belum_dibaca'
            ]);
        }

        if($status_pembayaran == 'ditolak' && $pembayaran_lama->status_pembayaran != 'ditolak'){

            $this->Pelunasan_custom_model->insert_notifikasi([
                'id_customer'      => $pembayaran_lama->id_customer,
                'id_pesanan'       => $pembayaran_lama->id_pesanan,
                'id_pembayaran'    => $id_pembayaran,
                'id_request'       => $pembayaran_lama->id_request,
                'target_role'      => 'customer',
                'jenis_notifikasi' => 'pelunasan_ditolak',
                'judul_notifikasi' => 'Pelunasan Custom Ditolak',
                'pesan_notifikasi' =>
                    'Bukti pembayaran pelunasan untuk pesanan ' .
                    $pembayaran_lama->kode_pesanan .
                    ' tidak dapat diverifikasi. Silakan upload ulang bukti pembayaran.',
                'status_baca'      => 'belum_dibaca'
            ]);
        }

        $this->session->set_flashdata('success', 'Status pelunasan berhasil diperbarui.');
        redirect('kasir/pelunasan-custom');
    }

    public function cetak_kwitansi($id_pembayaran)
    {
        $data['kwitansi'] =
            $this->Pelunasan_custom_model->get_kwitansi($id_pembayaran);

        if(!$data['kwitansi']){
            show_404();
        }

        $data['nama_kasir'] =
            $this->session->userdata('nama_user');

        $this->load->view('kasir/pembayaran/kwitansi_custom', $data);
    }
}