<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Keputusan_model
 *
 * @author Ady
 */
class Mining_model extends CI_Model {
    public function reset() {
        return $this->db->truncate('tbl_keputusan');
    }
    public function retrive_rule() {
        return $this->db->get('tbl_keputusan')->result();
    }
}
