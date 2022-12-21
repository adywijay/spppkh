<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Prediksi_model
 *
 * @author Ady
 */
class Prediksi_model extends CI_Model {

    public function retrive_all_prediksi() {
        return $this->db->where('keputusan_hasil', NULL)->get('tbl_hasil_prediksi')->result();
    }
    
    public function retrive_tanpa_syarat() {
        return $this->db->order_by('keputusan_hasil','YA','ASC')->get('tbl_hasil_prediksi')->result();
    }
    
    public function get_prediksi() {
        return $this->db->where('keputusan_hasil',!NULL)->get('tbl_hasil_prediksi')->result();
    }

    public function retrive_hasil_prediksi() {
        $tahun = $this->input->post('tahun');
        if ($tahun != NULL) {
            return $this->db->where('tahun', $tahun)->get('tbl_hasil_prediksi')->result();
        } else {
            return $this->db->get('tbl_hasil_prediksi')->result();
        }
    }
    
    public function retrive_layak() {
        $tahun = $this->input->post('tahun');
        if ($tahun != NULL) {
        $this->db->where('keputusan_hasil','YA');
        $this->db->where('tahun',$tahun);
        return $this->db->get('tbl_hasil_prediksi')->result();
        } else {
            return $this->db->where('tahun', $tahun and 'keputusan_hasil','YA')->get('tbl_hasil_prediksi')->result();
        }
    }
    
    public function retrive_cadangan() {
        $tahun = $this->input->post('tahun');
        if ($tahun != NULL) {
        $this->db->where('keputusan_hasil','TIDAK');
        $this->db->where('tahun',$tahun);
        return $this->db->get('tbl_hasil_prediksi')->result();
        } else {
            return $this->db->where('tahun', $tahun and 'keputusan_hasil','TIDAK')->get('tbl_hasil_prediksi')->result();
        }
    }
    
    public function cetak($kondisi) {
        return $this->db->where('tahun',$kondisi)->get('tbl_hasil_prediksi')->result();
    }
    
    public function print_layak($kondisi) {
        $this->db->where('tahun',$kondisi);
        $this->db->where('keputusan_hasil','YA');
        return $this->db->get('tbl_hasil_prediksi')->result();
    }

    public function truncate_prediksi() {
        return $this->db->truncate('tbl_hasil_prediksi');
    }
    
    public function delete_prediksi($id) {
        $this->db->where('id', $id);
        $perintah = $this->db->delete('tbl_hasil_prediksi');
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Dihapus..!');</script>";
            redirect('central', 'refresh');
        } else {
            echo "<script>alert('Record Gagal Dihapus..!');</script>";
            redirect('central', 'refresh');
        }
    }

}
