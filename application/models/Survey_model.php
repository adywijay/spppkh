<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Survey_model
 *
 * @author Ady
 */
class Survey_model extends CI_Model {

    public function insert_survey() {
        $art = $this->input->post('jml_art');
        $art_fix ='';
        if($art<=5){
          $art_fix = substr_replace($art,"SDT",0); 
        }elseif($art<=7){
          $art_fix = substr_replace($art,"SDG",0);  
        } else {
         $art_fix = substr_replace($art,"BYK",0);   
        }
        
        $keluarga = $this->input->post('jml_keluarga');
        $keluarga_fix ='';
        if($art<=2){
          $keluarga_fix = substr_replace($art,"KCL",0); 
        } else {
         $keluarga_fix = substr_replace($art,"BSR",0);   
        }
        $data = array(
            'nik'               => $this->input->post('nik'),
            'nama'              => $this->input->post('nama'),
            'kecamatan'         => $this->input->post('kecamatan'),
            'kabupaten'         => $this->input->post('kabupaten'),
            'propinsi'          => $this->input->post('propinsi'),
            'desa'              => $this->input->post('desa'),
            'alamat'            => $this->input->post('alamat'),
            'jml_art'           => $this->input->post('jml_art'),
            'art_temp'          => $art_fix,
            'jml_keluarga'      => $this->input->post('jml_keluarga'),
            'keluarga_temp'     => $keluarga_fix,
            'sta_lahan'         => $this->input->post('sta_lahan'),
            'sta_bangunan'      => $this->input->post('sta_bangunan'),
            'ls_lantai'         => $this->input->post('ls_lantai'),
            'jns_lantai'        => $this->input->post('jns_lantai'),
            'jns_dinding'       => $this->input->post('jns_dinding'),
            'knds_dinding'      => $this->input->post('knds_dinding'),
            'jns_atap'          => $this->input->post('jns_atap'),
            'knds_atap'         => $this->input->post('knds_atap'),
            'jml_kamar'         => $this->input->post('jml_kamar'),
            'smb_air_minum'     => $this->input->post('smb_air_minum'),
            'cmdp_air_minum'    => $this->input->post('cmdp_air_minum'),
            'smb_penerangan'    => $this->input->post('smb_penerangan'),
            'dy_listrik'        => $this->input->post('dy_listrik'),
            'bb_masak'          => $this->input->post('bb_masak'),
            'fasbab'            => $this->input->post('fasbab'),
            'jns_kloset'        => $this->input->post('jns_kloset'),
            'tp_akhir'          => $this->input->post('tp_akhir'),
            'ada_kulkas'        => $this->input->post('ada_kulkas'),
            'ada_ac'            => $this->input->post('ada_ac'),
            'ada_pemanas'       => $this->input->post('ada_pemanas'),
            'ada_telepon'       => $this->input->post('ada_telepon'),
            'ada_tgas'          => $this->input->post('ada_tgas'),
            'ada_tv'            => $this->input->post('ada_tv'),
            'ada_emas'          => $this->input->post('ada_emas'),
            'ada_komputer'      => $this->input->post('ada_komputer'),
            'ada_sepeda'        => $this->input->post('ada_sepeda'),
            'ada_motor'         => $this->input->post('ada_motor'),
            'ada_mobil'         => $this->input->post('ada_mobil'),
            'ada_ast_tbergerak' => $this->input->post('ada_ast_tbergerak'),
            'luas_ast_tbergerak'=> $this->input->post('luas_ast_tbergerak'),
            'ada_rumah_lain'    => $this->input->post('ada_rumah_lain'),
            'jml_sapi'          => $this->input->post('jml_sapi'),
            'jml_kambing'       => $this->input->post('jml_kambing'),
            'sta_art_usaha'     => $this->input->post('sta_art_usaha'),
            'sta_kks'           => $this->input->post('sta_kks'),
            'sta_kip'           => $this->input->post('sta_kip'),
            'sta_kis'           => $this->input->post('sta_kis'),
            'sta_bpjsm'         => $this->input->post('sta_bpjsm'),
            'sta_jamsotek'      => $this->input->post('sta_jamsotek'),
            'sta_asuransi_lain' => $this->input->post('sta_asuransi_lain'),
            'sta_rasta'         => $this->input->post('sta_rasta'),
            'sta_kur'           => $this->input->post('sta_kur'),
            'sta_keberadaan_art'=> $this->input->post('sta_keberadaan_art'),
            'percentile'        => $this->input->post('percentile'),
            'ls_lahan'          => $this->input->post('ls_lahan'),
            'id_akun'           => $this->input->post('id_akun')
        );
        return $this->db->insert('tbl_master', $data);
    }

    public function retrive_by() {
        $this->db->select('*');
        $this->db->where('id_akun', $this->session->userdata('id_akun'));
        $query = $this->db->limit(10)->get('tbl_master');
        return $query->result();
    }
    
    public function retrive_all() {
        return $this->db->limit(10)->order_by('tgl_input')->get('tbl_master')->result();
    }

    public function get_detail_survey($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->limit(1)->get('tbl_master');
        return $query->row_array();
    }
    public function get_edit($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->limit(1)->get('tbl_master');
        return $query->row_array();
    }

    public function update_survey($id) {
        $id = $this->input->post('id');
        $data = array(
          'nik'               => $this->input->post('nik'),
          'nama'              => $this->input->post('nama'),
          'kecamatan'         => $this->input->post('kecamatan'),
          'kabupaten'         => $this->input->post('kabupaten'),
          'propinsi'          => $this->input->post('propinsi'),
          'desa'              => $this->input->post('desa'),
          'alamat'            => $this->input->post('alamat'),
          'jml_art'           => $this->input->post('jml_art'),
          'jml_keluarga'      => $this->input->post('jml_keluarga'),
          'sta_lahan'         => $this->input->post('sta_lahan'),
          'sta_bangunan'      => $this->input->post('sta_bangunan'),
          'ls_lantai'         => $this->input->post('ls_lantai'),
          'jns_lantai'        => $this->input->post('jns_lantai'),
          'jns_dinding'       => $this->input->post('jns_dinding'),
          'knds_dinding'      => $this->input->post('knds_dinding'),
          'jns_atap'          => $this->input->post('jns_atap'),
          'knds_atap'         => $this->input->post('knds_atap'),
          'jml_kamar'         => $this->input->post('jml_kamar'),
          'smb_air_minum'     => $this->input->post('smb_air_minum'),
          'cmdp_air_minum'    => $this->input->post('cmdp_air_minum'),
          'smb_penerangan'    => $this->input->post('smb_penerangan'),
          'dy_listrik'        => $this->input->post('dy_listrik'),
          'bb_masak'          => $this->input->post('bb_masak'),
          'fasbab'            => $this->input->post('fasbab'),
          'jns_kloset'        => $this->input->post('jns_kloset'),
          'tp_akhir'          => $this->input->post('tp_akhir'),
          'ada_kulkas'        => $this->input->post('ada_kulkas'),
          'ada_ac'            => $this->input->post('ada_ac'),
          'ada_pemanas'       => $this->input->post('ada_pemanas'),
          'ada_telepon'       => $this->input->post('ada_telepon'),
          'ada_tgas'          => $this->input->post('ada_tgas'),
          'ada_tv'            => $this->input->post('ada_tv'),
          'ada_emas'          => $this->input->post('ada_emas'),
          'ada_komputer'      => $this->input->post('ada_komputer'),
          'ada_sepeda'        => $this->input->post('ada_sepeda'),
          'ada_motor'         => $this->input->post('ada_motor'),
          'ada_mobil'         => $this->input->post('ada_mobil'),
          'ada_ast_tbergerak' => $this->input->post('ada_ast_tbergerak'),
          'luas_ast_tbergerak'=> $this->input->post('luas_ast_tbergerak'),
          'ada_rumah_lain'    => $this->input->post('ada_rumah_lain'),
          'jml_sapi'          => $this->input->post('jml_sapi'),
          'jml_kambing'       => $this->input->post('jml_kambing'),
          'sta_art_usaha'     => $this->input->post('sta_art_usaha'),
          'sta_kks'           => $this->input->post('sta_kks'),
          'sta_kip'           => $this->input->post('sta_kip'),
          'sta_kis'           => $this->input->post('sta_kis'),
          'sta_bpjsm'         => $this->input->post('sta_bpjsm'),
          'sta_jamsotek'      => $this->input->post('sta_jamsotek'),
          'sta_asuransi_lain' => $this->input->post('sta_asuransi_lain'),
          'sta_rasta'         => $this->input->post('sta_rasta'),
          'sta_kur'           => $this->input->post('sta_kur'),
          'sta_keberadaan_art'=> $this->input->post('sta_keberadaan_art'),
          'percentile'        => $this->input->post('percentile'),
          'ls_lahan'          => $this->input->post('ls_lahan')
        );
        $this->db->where('id',$this->input->post('id'));
        return $this->db->update('tbl_master',$data);
//          $data = array(
//          'nik'               => $this->input->post('nik'),
//          'nama'              => $this->input->post('nama'),
//          'kecamatan'         => $this->input->post('kecamatan'),
//          'kabupaten'         => $this->input->post('kabupaten'),
//          'propinsi'          => $this->input->post('propinsi'),
//          'desa'              => $this->input->post('desa'),
//          'alamat'            => $this->input->post('alamat'),
//          'jml_art'           => $this->input->post('jml_art'),
//          'jml_keluarga'      => $this->input->post('jml_keluarga'),
//          'sta_lahan'         => $this->input->post('sta_lahan'),
//          'sta_bangunan'      => $this->input->post('sta_bangunan'),
//          'ls_lantai'         => $this->input->post('ls_lantai'),
//          'jns_lantai'        => $this->input->post('jns_lantai'),
//          'jns_dinding'       => $this->input->post('jns_dinding'),
//          'knds_dinding'      => $this->input->post('knds_dinding'),
//          'jns_atap'          => $this->input->post('jns_atap'),
//          'knds_atap'         => $this->input->post('knds_atap'),
//          'jml_kamar'         => $this->input->post('jml_kamar'),
//          'smb_air_minum'     => $this->input->post('smb_air_minum'),
//          'cmdp_air_minum'    => $this->input->post('cmdp_air_minum'),
//          'smb_penerangan'    => $this->input->post('smb_penerangan'),
//          'dy_listrik'        => $this->input->post('dy_listrik'),
//          'bb_masak'          => $this->input->post('bb_masak'),
//          'fasbab'            => $this->input->post('fasbab'),
//          'jns_kloset'        => $this->input->post('jns_kloset'),
//          'tp_akhir'          => $this->input->post('tp_akhir'),
//          'ada_kulkas'        => $this->input->post('ada_kulkas'),
//          'ada_ac'            => $this->input->post('ada_ac'),
//          'ada_pemanas'       => $this->input->post('ada_pemanas'),
//          'ada_telepon'       => $this->input->post('ada_telepon'),
//          'ada_tgas'          => $this->input->post('ada_tgas'),
//          'ada_tv'            => $this->input->post('ada_tv'),
//          'ada_emas'          => $this->input->post('ada_emas'),
//          'ada_komputer'      => $this->input->post('ada_komputer'),
//          'ada_sepeda'        => $this->input->post('ada_sepeda'),
//          'ada_motor'         => $this->input->post('ada_motor'),
//          'ada_mobil'         => $this->input->post('ada_mobil'),
//          'ada_ast_tbergerak' => $this->input->post('ada_ast_tbergerak'),
//          'luas_ast_tbergerak'=> $this->input->post('luas_ast_tbergerak'),
//          'ada_rumah_lain'    => $this->input->post('ada_rumah_lain'),
//          'jml_sapi'          => $this->input->post('jml_sapi'),
//          'jml_kambing'       => $this->input->post('jml_kambing'),
//          'sta_art_usaha'     => $this->input->post('sta_art_usaha'),
//          'sta_kks'           => $this->input->post('sta_kks'),
//          'sta_kip'           => $this->input->post('sta_kip'),
//          'sta_bpjsm'         => $this->input->post('sta_bpjsm'),
//          'sta_jamsotek'      => $this->input->post('sta_jamsotek'),
//          'sta_asuransi_lain' => $this->input->post('sta_asuransi_lain'),
//          'sta_rasta'         => $this->input->post('sta_rasta'),
//          'sta_kur'           => $this->input->post('sta_kur'),
//          'sta_keberadaan_art'=> $this->input->post('sta_keberadaan_art'),
//          'percentile'        => $this->input->post('percentile'),
//          'ls_lahan'          => $this->input->post('ls_lahan')
//          );
//        $this->db->where('id', $this->input->post('id'));
//        $this->db->update('tbl_master', $data);

//          $nik                  = $this->input->post('nik');
//          $nama                 = $this->input->post('nama');
//          $kecamatan            = $this->input->post('kecamatan');
//          $kabupaten            = $this->input->post('kabupaten');
//          $propinsi             = $this->input->post('propinsi');
//          $desa                 = $this->input->post('desa');
//          $alamat               = $this->input->post('alamat');
//          $jml_art              = $this->input->post('jml_art');
//          $jml_keluarga         = $this->input->post('jml_keluarga');
//          $sta_lahan            = $this->input->post('sta_lahan');
//          $sta_bangunan         = $this->input->post('sta_bangunan');
//          $ls_lantai            = $this->input->post('ls_lantai');
//          $jns_lantai           = $this->input->post('jns_lantai');
//          $jns_dinding          = $this->input->post('jns_dinding');
//          $knds_dinding         = $this->input->post('knds_dinding');
//          $jns_atap             = $this->input->post('jns_atap');
//          $knds_atap            = $this->input->post('knds_atap');
//          $jml_kamar            = $this->input->post('jml_kamar');
//          $smb_air_minum        = $this->input->post('smb_air_minum');
//          $cmdp_air_minum       = $this->input->post('cmdp_air_minum');
//          $smb_penerangan       = $this->input->post('smb_penerangan');
//          $dy_listrik           = $this->input->post('dy_listrik');
//          $bb_masak             = $this->input->post('bb_masak');
//          $fasbab               = $this->input->post('fasbab');
//          $jns_kloset           = $this->input->post('jns_kloset');
//          $tp_akhir             = $this->input->post('tp_akhir');
//          $ada_kulkas           = $this->input->post('ada_kulkas');
//          $ada_ac               = $this->input->post('ada_ac');
//          $ada_pemanas          = $this->input->post('ada_pemanas');
//          $ada_telepon          = $this->input->post('ada_telepon');
//          $ada_tgas             = $this->input->post('ada_tgas');
//          $ada_tv               = $this->input->post('ada_tv');
//          $ada_emas             = $this->input->post('ada_emas');
//          $ada_komputer         = $this->input->post('ada_komputer');
//          $ada_sepeda           = $this->input->post('ada_sepeda');
//          $ada_motor            = $this->input->post('ada_motor');
//          $ada_mobil            = $this->input->post('ada_mobil');
//          $ada_ast_tbergerak    = $this->input->post('ada_ast_tbergerak');
//          $luas_ast_tbergerak   = $this->input->post('luas_ast_tbergerak');
//          $ada_rumah_lain       = $this->input->post('ada_rumah_lain');
//          $jml_sapi             = $this->input->post('jml_sapi');
//          $jml_kambing          = $this->input->post('jml_kambing');
//          $sta_art_usaha        = $this->input->post('sta_art_usaha');
//          $sta_kks              = $this->input->post('sta_kks');
//          $sta_kip              = $this->input->post('sta_kip');
//          $sta_bpjsm            = $this->input->post('sta_bpjsm');
//          $sta_jamsotek         = $this->input->post('sta_jamsotek');
//          $sta_asuransi_lain  = $this->input->post('sta_asuransi_lain');
//          $sta_rasta            = $this->input->post('sta_rasta');
//          $sta_kur              = $this->input->post('sta_kur');
//          $sta_keberadaan_art   = $this->input->post('sta_keberadaan_art');
//          $percentile           = $this->input->post('percentile');
//          $ls_lahan             = $this->input->post('ls_lahan');
//          $id                   = $this->input->post('id');
//
//
//          $data = array(
//          'nik'                  => $nik,
//          'nama'                 => $nama,
//          'kecamatan'            => $kecamatan,
//          'kabupaten'            => $kabupaten,
//          'propinsi'             => $propinsi,
//          'desa'                 => $desa,
//          'alamat'               => $alamat,
//          'jml_art'              => $jml_art,
//          'jml_keluarga'         => $jml_keluarga,
//          'sta_lahan'            => $sta_lahan,
//          'sta_bangunan'         => $sta_bangunan,
//          'ls_lantai'            => $ls_lantai,
//          'jns_lantai'           => $jns_lantai,
//          'jns_dinding'          => $jns_dinding,
//          'knds_dinding'         => $knds_dinding,
//          'jns_atap'             => $jns_atap,
//          'knds_atap'            => $knds_atap,
//          'jml_kamar'            => $jml_kamar,
//          'smb_air_minum'        => $smb_air_minum,
//          'cmdp_air_minum'       => $cmdp_air_minum,
//          'smb_penerangan'       => $smb_penerangan,
//          'dy_listrik'           => $dy_listrik,
//          'bb_masak'             => $bb_masak,
//          'fasbab'               => $fasbab,
//          'jns_kloset'           => $jns_kloset,
//          'tp_akhir'             => $tp_akhir,
//          'ada_kulkas'           => $ada_kulkas,
//          'ada_ac'               => $ada_ac,
//          'ada_pemanas'          => $ada_pemanas,
//          'ada_telepon'          => $ada_telepon,
//          'ada_tgas'             => $ada_tgas,
//          'ada_tv'               => $ada_tv,
//          'ada_emas'             => $ada_emas,
//          'ada_komputer'         => $ada_komputer,
//          'ada_sepeda'           => $ada_sepeda,
//          'ada_motor'            => $ada_motor,
//          'ada_mobil'            => $ada_mobil,
//          'ada_ast_tbergerak'    => $ada_ast_tbergerak,
//          'luas_ast_tbergerak'   => $luas_ast_tbergerak,
//          'ada_rumah_lain'       => $ada_rumah_lain,
//          'jml_sapi'             => $jml_sapi,
//          'jml_kambing'          => $jml_kambing,
//          'sta_art_usaha'        => $sta_art_usaha,
//          'sta_kks'              => $sta_kks,
//          'sta_kip'              => $sta_kip,
//          'sta_bpjsm'            => $sta_bpjsm,
//          'sta_jamsotek'         => $sta_jamsotek,
//          'sta_asuransi_lain'    => $sta_asuransi_lain,
//          'sta_rasta'            => $sta_rasta,
//          'sta_kur'              => $sta_kur,
//          'sta_keberadaan_art'   => $sta_keberadaan_art,
//          'percentile'           => $percentile,
//          'ls_lahan'             => $ls_lahan
////          'id'                   => $id,
//        );
//        $where = array('id' => $id);
//        //$this->db->where('id',$where);
//        return $this->db->update('tbl_master',$data,$where);
    }

    public function reset() {
        return $this->db->truncate('tbl_master');
    }

    public function delete_survey($id) {
        $this->db->where('id', $id);
        $perintah = $this->db->delete('tbl_master');
        return $perintah;
    }

    public function count_by() {
        $count_query = $this->db->where('id_akun', $this->session->userdata('id_akun'))->get('tbl_master');
        return $count_query->num_rows();
    }

}
