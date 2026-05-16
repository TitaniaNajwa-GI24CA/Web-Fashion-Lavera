<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class buku_model extends CI_Model {
    private $table = 'buku';

    //Ambil Semua Data//
    function get_all()
    {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id = buku.kategori');
        return $this->db->get()->result();
    }

    // MENCARI DATA//
    public function get_by_id($buku_id)
    {
        $this->db->where('buku_id', $buku_id);
        return $this->db->get('buku')->row();
    }
    //INSERT DATA//
    public function insert($data)
    {
        return $this->db->insert($this->table,$data);
    }
    //HAPUS DATA//
    public function delete($buku_id)
    {
        return $this->db->delete($this->table,['buku_id'=>$buku_id]);
    }
    //UPDATE DATA//
   public function update($buku_id, $data)
    {
        $this->db->where('buku_id', $buku_id);
        $this->db->update($this->table, $data);
    }

}
