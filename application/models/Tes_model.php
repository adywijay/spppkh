<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tes_model
 *
 * @author Ady
 */
class Tes_model extends CI_Model {
    public function retrive_atribut() {
        $this->db->select('atribut,nilai_atribut');
        return $this->db->get('tbl_atribut');
      
//       return $this->db->get('tbl_atribut')->result();
    }
    public function get_latih() {
     $this->db->order_by('id');
     $query = $this->$this->db->get('tbl_data_latih');
     return $query->result_array();
    }
}
