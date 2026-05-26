<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk_pakaian_jadi_model extends CI_Model {

    public function get_all()
    {
        return $this->db
            ->order_by('created_at', 'DESC')
            ->get('tbl_pakaian_jadi')
            ->result();
    }

    public function insert($data)
    {
        return $this->db->insert('tbl_pakaian_jadi', $data);
    }

    
}