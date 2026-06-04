<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori_custom_model extends CI_Model {
    
    public function get_all()
    {
        return $this->db
            ->order_by('id_custom', 'DESC')
            ->get('tbl_custom')
            ->result();
    }

    public function insert($data)
    {
        return $this->db->insert('tbl_custom', $data);
    }

    public function get_custom_admin_aktif()
    {
        return $this->db
            ->where('status_custom', 'Aktif')
            ->where_not_in('id_custom', [1, 2, 3, 4])
            ->order_by('id_custom', 'DESC')
            ->get('tbl_custom')
            ->result();
    }

    public function delete($id_custom)
    {
        return $this->db
            ->where('id_custom', $id_custom)
            ->delete('tbl_custom');
    }

    public function get_by_id($id_custom)
    {
        return $this->db
            ->where('id_custom', $id_custom)
            ->get('tbl_custom')
            ->row();
    }

    public function update($id_custom, $data)
    {
        return $this->db
            ->where('id_custom', $id_custom)
            ->update('tbl_custom', $data);
    }
}