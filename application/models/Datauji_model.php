<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Datauji
 *
 * @author Ady
 */
class Datauji_model extends CI_Model {

    public function retrive_all() {
        return $this->db->get('tbl_data_uji')->result();
    }
    
    public function jml_data() {
        return $this->db->get('tbl_data_uji')->num_rows();
    }
    
    public function truncate_dtuji() {
        return $this->db->truncate('tbl_data_uji');
    }

}
