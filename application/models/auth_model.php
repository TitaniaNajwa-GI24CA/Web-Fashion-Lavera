<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth_model extends CI_Model {

    public function insert_user($data)
    {
        $this->db->insert('tbl_users', $data);
        return $this->db->insert_id();
    }

    public function insert_customer($data)
    {
        return $this->db->insert('tbl_customer', $data);
    }

    public function get_user_by_login($login)
    {
        $this->db->where('username', $login);
        $this->db->or_where('email', $login);
        return $this->db->get('tbl_users')->row();
    }

    public function update_last_login($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->update('tbl_users', [
            'last_login' => date('Y-m-d H:i:s')
        ]);
    }

    public function cek_username($username)
    {
        return $this->db
            ->where('username', $username)
            ->get('tbl_users')
            ->row();
    }

    public function insert_staff($data_user)
    {
        $this->db->insert('tbl_users', $data_user);
        $id_user = $this->db->insert_id();

        if($data_user['role'] == 'admin'){

            $this->db->insert('tbl_admin', [
                'id_user' => $id_user
            ]);

        } elseif($data_user['role'] == 'kasir'){

            $this->db->insert('tbl_kasir', [
                'id_user' => $id_user
            ]);
        }
        return $id_user;
    }
}