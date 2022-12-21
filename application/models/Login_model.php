<?php

/**
 * Description of Login_model
 *
 * @author Ady
 */
class Login_model extends CI_Model {
    public function get_login($username,$password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->limit(1)->get('tbl_akun');
        /*
         * $this->db->where('username',$username);
        $this->db->where('password',$password);
        return $this->db->gt('tbl_akun')->num_rows();
         * 
         */
    }
}
