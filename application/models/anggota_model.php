<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class anggota_model extends CI_Model {
    private $table = 'anggota';

    //Ambil Semua Data//
    function get_all()
    {
        $this->db->from('anggota');
        return $this->db->get()->result();
    }

    // MENCARI DATA//
    public function get_by_id($id_anggota)
    {
        $this->db->where('id_anggota', $id_anggota);
        return $this->db->get('anggota')->row();
    }
    //INSERT DATA//
    public function insert($data)
    {
        return $this->db->insert($this->table,$data);
    }
    //HAPUS DATA//
    public function delete($id_anggota)
    {
        return $this->db->delete($this->table,['id_anggota'=>$id_anggota]);
    }
    //UPDATE DATA//
   public function update($id_anggota, $data)
    {
        $this->db->where('id_anggota', $id_anggota);
        $this->db->update($this->table, $data);
    }

}
