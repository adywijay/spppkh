<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surveyer extends CI_Controller {
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('id_akses') != '1') {
            echo "<script>alert('Anda Tidak Mempunyai Hak Untuk Akses Sistem..!');</script>";
            redirect('welcome', 'refresh');
        }
    }


    /*
	+--------------------------------------------------------------------+
	|----------------------Fungsi Load Tampilan--------------------------|
	+--------------------------------------------------------------------+
	*/
        public function index(){
            $data['title'] = "Beranda";
            $this->load->view('surveyer/layout/header',$data);
            $this->load->view('surveyer/layout/navigasi');
            $this->load->view('surveyer/konten/beranda');
            $this->load->view('surveyer/layout/footer');
	}
        //--------------------CRU SURVEY------------------------------------
        public function tampil_survey(){
            $data['title'] = "Data Survey";
            $data['surveyer'] = $this->survey_model->retrive_by();
            $this->load->view('surveyer/layout/header',$data);
            $this->load->view('surveyer/layout/navigasi');
            $this->load->view('surveyer/konten/survey');
            $this->load->view('surveyer/layout/footer');
	}
        public function detail_survey($id){
            $data['surveyer'] = $this->survey_model->get_detail_survey($id);
            $data['title'] = "Data Survey";
            $this->load->view('surveyer/layout/header', $data);
            $this->load->view('surveyer/layout/navigasi');
            $this->load->view('surveyer/konten/survey_detail');
            $this->load->view('surveyer/layout/footer');
        }
        public function edit_survey($id){
            $data['surveyer'] = $this->survey_model->get_detail_survey($id);
            $data['title'] = "Edit Data Survey";
            $this->load->view('surveyer/layout/header', $data);
            $this->load->view('surveyer/layout/navigasi');
            $this->load->view('surveyer/konten/edit_survey');
            $this->load->view('surveyer/layout/footer');
        }
        public function tambah_survey() {
        $data['title'] = "Form Data Survey";
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('desa', 'Desa', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jml_art', 'Jumlah ART', 'required');
        $this->form_validation->set_rules('jml_keluarga', 'Jumlah Keluarga', 'required');
        $this->form_validation->set_rules('sta_lahan', 'Status Lahan', 'required');
        $this->form_validation->set_rules('sta_bangunan', 'Status Bangunan', 'required');
        $this->form_validation->set_rules('ls_lantai', 'Luas Lantai', 'required');
        $this->form_validation->set_rules('jns_lantai', 'Jenis Lantai', 'required');
        $this->form_validation->set_rules('jns_dinding', 'Jenis Dinding', 'required');
        $this->form_validation->set_rules('knds_dinding', 'Kondisi Dinding', 'required');
        $this->form_validation->set_rules('jns_atap', 'Jenis Atap', 'required');
        $this->form_validation->set_rules('knds_atap', 'Kondisi Atap', 'required');
        $this->form_validation->set_rules('jml_kamar', 'Jumlah Kamar', 'required');
        $this->form_validation->set_rules('smb_air_minum', 'Sumber Air Minum', 'required');
        $this->form_validation->set_rules('cmdp_air_minum', 'Cara Mendapat Air', 'required');
        $this->form_validation->set_rules('smb_penerangan', 'Sumber Penerangan', 'required');
        $this->form_validation->set_rules('dy_listrik', 'Daya Listrik', 'required');
        $this->form_validation->set_rules('bb_masak', 'Bahan Bakar Masak', 'required');
        $this->form_validation->set_rules('fasbab', 'Fasil BAB', 'required');
        $this->form_validation->set_rules('jns_kloset', 'Jenis Kloset', 'required');
        $this->form_validation->set_rules('tp_akhir', 'Tempat Pembuangan', 'required');
        $this->form_validation->set_rules('ada_kulkas', 'Ada Kulkas', 'required');
        $this->form_validation->set_rules('ada_ac', 'Ada AC', 'required');
        $this->form_validation->set_rules('ada_pemanas', 'Ada Pemanas', 'required');
        $this->form_validation->set_rules('ada_telepon', 'Ada Telepon', 'required');
        $this->form_validation->set_rules('ada_tgas', 'Tabung Gas > 5 KG', 'required');
        $this->form_validation->set_rules('ada_tv', 'Ada Tv', 'required');
        $this->form_validation->set_rules('ada_emas', 'Ada Emas', 'required');
        $this->form_validation->set_rules('ada_komputer', 'Ada Komputer', 'required');
        $this->form_validation->set_rules('ada_sepeda', 'Ada Sepeda', 'required');
        $this->form_validation->set_rules('ada_motor', 'Ada Motor', 'required');
        $this->form_validation->set_rules('ada_mobil', 'Ada Mobil', 'required');
        $this->form_validation->set_rules('ada_ast_tbergerak', 'Aset Tak Bergerak', 'required');
        $this->form_validation->set_rules('luas_ast_tbergerak', 'Luas Aset Tak Bergerak', 'required');
        $this->form_validation->set_rules('ada_rumah_lain', 'Ada Rumah Lain', 'required');
        $this->form_validation->set_rules('jml_sapi', 'Jumlah Sapi', 'required');
        $this->form_validation->set_rules('jml_kambing', 'Jumlah Kambing', 'required');
        $this->form_validation->set_rules('sta_art_usaha', 'Status ART Usaha', 'required');
        $this->form_validation->set_rules('sta_kks', 'Status KKS', 'required');
        $this->form_validation->set_rules('sta_kip', 'Status KIP', 'required');
        $this->form_validation->set_rules('sta_bpjsm', 'Status BPJSM', 'required');
        $this->form_validation->set_rules('sta_jamsotek', 'Status JAMSOSTEK', 'required');
        $this->form_validation->set_rules('sta_asuransi_lain', 'Status Asuransi Kesehatan', 'required');
        $this->form_validation->set_rules('sta_rasta', 'Status RASTA', 'required');
        $this->form_validation->set_rules('sta_kur', 'Status KUR', 'required');
        $this->form_validation->set_rules('sta_keberadaan_art', 'Status Keberadaan ART', 'required');
        $this->form_validation->set_rules('percentile', 'Percentile', 'required');
            
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('surveyer/layout/header', $data);
                $this->load->view('surveyer/layout/navigasi');
                $this->load->view('surveyer/konten/add_survey');
                $this->load->view('surveyer/layout/footer');
            } else {
                $perintah = $this->survey_model->insert_survey();
                if ($perintah == TRUE) {
                    echo "<script>alert('Data Berhasil Disimpan..!');</script>";
                    redirect('tampil_survey', 'refresh');
                } else {
                    echo "<script>alert('Data Gagal Disimpan..!');</script>";
                    redirect('tampil_survey', 'refresh');
                }
            }
    }

    //------------------------------------------------------------------+
        
        /*
	+-------------------------------------------------------------------+
	|---------------------- FLM ==== SURVEY --------------------|
	+-------------------------------------------------------------------+
	*/
        public function logout_survey(){
            $this->session->sess_destroy();
            //pesan
            $this->session->set_flashdata('pesan','Log Out Berhasil');
            redirect('welcome',$data);
        }
}
