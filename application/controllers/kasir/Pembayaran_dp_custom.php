<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_dp_custom extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('kasir/Pembayaran_dp_custom_model');
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

        $data['page_title'] = 'Pembayaran Uang Muka Custom';
        $data['page_subtitle'] = 'Kelola verifikasi pembayaran DP custom outfit.';

        $data['pembayaran'] =
            $this->Pembayaran_dp_custom_model->get_all();

        $this->load->view('kasir/layouts/header');
        $this->load->view('kasir/layouts/sidebar');
        $this->load->view('kasir/layouts/topbar', $data);
        $this->load->view('kasir/pembayaran/pembayaran_dp_custom', $data);
        $this->load->view('kasir/layouts/footer');
    }

    public function update_status()
    {
        $id_pembayaran = $this->input->post('id_pembayaran', true);
        $status_pembayaran = $this->input->post('status_pembayaran', true);

        $pembayaran_lama =
            $this->Pembayaran_dp_custom_model->get_by_id($id_pembayaran);

        if(!$pembayaran_lama){
            show_404();
        }

        $this->Pembayaran_dp_custom_model->update($id_pembayaran, [
            'status_pembayaran' => $status_pembayaran
        ]);

        if($status_pembayaran == 'berhasil' && $pembayaran_lama->status_pembayaran != 'berhasil'){

            $this->Pembayaran_dp_custom_model->update_pesanan(
                $pembayaran_lama->id_pesanan,
                ['status_pesanan' => 'diproses']
            );

            $cek_pelunasan =
                $this->Pembayaran_dp_custom_model->cek_pelunasan($pembayaran_lama->id_pesanan);

            if(!$cek_pelunasan){

                $sisa_pelunasan =
                    $pembayaran_lama->estimasi_harga - $pembayaran_lama->uang_muka;

                $this->Pembayaran_dp_custom_model->insert_pembayaran([
                    'id_pesanan'         => $pembayaran_lama->id_pesanan,
                    'id_request'         => $pembayaran_lama->id_request,
                    'kode_pembayaran'    => 'PAY-PLN-' . date('YmdHis'),
                    'jenis_pembayaran'   => 'pelunasan_custom',
                    'metode_pembayaran'  => NULL,
                    'jumlah_bayar'       => $sisa_pelunasan,
                    'bukti_pembayaran'   => NULL,
                    'status_pembayaran'  => 'belum_bayar'
                ]);
            }

            $this->Pembayaran_dp_custom_model->insert_notifikasi([
                'id_customer'      => $pembayaran_lama->id_customer,
                'id_pesanan'       => $pembayaran_lama->id_pesanan,
                'id_pembayaran'    => $id_pembayaran,
                'id_request'       => $pembayaran_lama->id_request,
                'target_role'      => 'customer',
                'jenis_notifikasi' => 'dp_berhasil',
                'judul_notifikasi' => 'Pembayaran Uang Muka Berhasil',
                'pesan_notifikasi' =>
                    'Pembayaran uang muka untuk pesanan ' .
                    $pembayaran_lama->kode_pesanan .
                    ' telah diverifikasi. Silakan lanjutkan pembayaran pelunasan.',
                'status_baca'      => 'belum_dibaca'
            ]);
        }

        if($status_pembayaran == 'ditolak' && $pembayaran_lama->status_pembayaran != 'ditolak'){

            $this->Pembayaran_dp_custom_model->update_pesanan(
                $pembayaran_lama->id_pesanan,
                ['status_pesanan' => 'pending']
            );

            $this->Pembayaran_dp_custom_model->insert_notifikasi([
                'id_customer'      => $pembayaran_lama->id_customer,
                'id_pesanan'       => $pembayaran_lama->id_pesanan,
                'id_pembayaran'    => $id_pembayaran,
                'id_request'       => $pembayaran_lama->id_request,
                'target_role'      => 'customer',
                'jenis_notifikasi' => 'dp_ditolak',
                'judul_notifikasi' => 'Pembayaran Uang Muka Ditolak',
                'pesan_notifikasi' =>
                    'Bukti pembayaran uang muka untuk pesanan ' .
                    $pembayaran_lama->kode_pesanan .
                    ' tidak dapat diverifikasi. Silakan upload ulang bukti pembayaran.',
                'status_baca'      => 'belum_dibaca'
            ]);
        }

        $this->session->set_flashdata('success', 'Status pembayaran DP berhasil diperbarui.');
        redirect('kasir/pembayaran-dp-custom');
    }
}