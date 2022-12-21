<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dtlatih_model
 *
 * @author Ady
 */
class Datalatih_model extends CI_Model {
    public function retrive_dtlatih() {
     return $this->db->order_by('id','ASC')->get('tbl_data_latih')->result();
    }
   
}
