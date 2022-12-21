<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('id_akses') != '2') {
            echo "<script>alert('Anda Tidak Mempunyai Hak Untuk Akses Sistem..!');</script>";
            redirect('welcome', 'refresh');
        }
    }

    /*
      +--------------------------------------------------------------------+
      |----------------------Fungsi Load Tampilan--------------------------|
      +--------------------------------------------------------------------+
     */

    public function index()
    {
        $data['title'] = "Beranda";
        $this->load->view('operator/layout/header', $data);
        $this->load->view('operator/layout/navigasi');
        $this->load->view('operator/konten/beranda');
        $this->load->view('operator/layout/footer');
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_akses');
        $this->session->unset_userdata('id_akun');
        $this->session->unset_userdata('foto');
        $this->session->unset_userdata('jabatan');
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('token');
        $this->session->unset_userdata('password');
        $this->session->unset_userdata('validasi');
        $this->session->sess_destroy();
        $this->session->set_flashdata(
            'pesan',
            '<div id="card-alert" class="card red">
                      <div class="card-content white-text">
                        <p><i class="material-icons">error_outline</i>&nbsp; Logout Sucess</p>
                      </div>
                    </div>'
        );
        redirect('welcome');
    }

    //--------------------CRUD SURVEY------------------------------------
    public function tambah_survey()
    {
        $data['title'] = "Laman Form Input Survey";
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
            $this->load->view('operator/layout/header', $data);
            $this->load->view('operator/layout/navigasi');
            $this->load->view('operator/konten/add_survey');
            $this->load->view('operator/layout/footer');
        } else {
            $perintah = $this->survey_model->insert_survey();
            if ($perintah == TRUE) {
                echo "<b><script>alert('Data Berhasil Disimpan..!');</script></b>";
                redirect('surveyer/tampil_survey', 'refresh');
            } else {
                echo "<script>window.alert('Data Gagal Disimpan..!');window.location=('surveyer/tambah_survey')</script>";
            }
        }
    }

    public function tampil_hasil_prediksi()
    {
        $data['title'] = "Halaman Hasil Prediksi";
        $data['operator'] = $this->prediksi_model->retrive_hasil_prediksi();
        $this->load->view('operator/layout/header', $data);
        $this->load->view('operator/layout/navigasi');
        $this->load->view('operator/konten/hasil_prediksi');
        $this->load->view('operator/layout/footer');
    }

    public function tampil_layak()
    {
        $data['title'] = "Halaman Hasil Prediksi";
        $data['operator'] = $this->prediksi_model->retrive_layak();
        $this->load->view('operator/layout/header', $data);
        $this->load->view('operator/layout/navigasi');
        $this->load->view('operator/konten/view_layak');
        $this->load->view('operator/layout/footer');
    }

    public function tampil_tidak()
    {
        $data['title'] = "Halaman Hasil Prediksi";
        $data['operator'] = $this->prediksi_model->retrive_cadangan();
        $this->load->view('operator/layout/header', $data);
        $this->load->view('operator/layout/navigasi');
        $this->load->view('operator/konten/view_tidak_menerima');
        $this->load->view('operator/layout/footer');
    }

    public function tampil_survey()
    {
        $data['title'] = "Halaman Tampil Survey";
        $data['operator'] = $this->survey_model->retrive_all();
        $this->load->view('operator/layout/header', $data);
        $this->load->view('operator/layout/navigasi');
        $this->load->view('operator/konten/view_survey');
        $this->load->view('operator/layout/footer');
    }

    public function tampil_petugas()
    {
        $data['title'] = "Halaman Tampil Petugas";
        $data['operator'] = $this->akun_model->get_akun_surveyer();
        $this->load->view('operator/layout/header', $data);
        $this->load->view('operator/layout/navigasi');
        $this->load->view('operator/konten/view_petugas_survey');
        $this->load->view('operator/layout/footer');
    }

    public function detail_survey($id)
    {
        $data['operator'] = $this->survey_model->get_detail_survey($id);
        $data['title'] = "Halaman Detail Survey";
        $this->load->view('operator/layout/header', $data);
        $this->load->view('operator/layout/navigasi');
        $this->load->view('operator/konten/view_detail_survey');
        $this->load->view('operator/layout/footer');
    }

    public function detail_edit($id)
    {
        $data['title'] = "Laman Form Edit Survey";
        $data['operator'] = $this->survey_model->get_edit($id);
        $this->load->view('operator/layout/header', $data);
        $this->load->view('operator/layout/navigasi');
        $this->load->view('operator/konten/view_edit_survey');
        $this->load->view('operator/layout/footer');
    }

    //------------------------------------------------------------------+

    /*
      +-------------------------------------------------------------------+
      |---------------------- FLM ==== SURVEY --------------------|
      +-------------------------------------------------------------------+
     */
    public function action_edit()
    {
        $perintah = $this->survey_model->update_survey();
        if ($perintah == TRUE) {
            echo "<b><script>alert('Data Berhasil Diupdate..!');</script></b>";
            redirect('operator/tampil_survey', 'refresh');
        } else {
            echo "<script>window.alert('Data Gagal Diupdate..!');window.location=('operator/tampil_survey')</script>";
        }
    }
    public function hapus_survey($id)
    {
        $perintah = $this->survey_model->delete_survey($id);
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Dihapus..!');</script>";
            redirect('operator/tampil_survey', 'refresh');
        } else {
            echo "<script>alert('Record Gagal Dihapus..!');</script>";
            redirect('operator/tampil_survey', 'refresh');
        }
    }

    /*
      +-------------------------------------------------------------------+
      |---------------------- FLM ==== PREDIKSI --------------------|
      +-------------------------------------------------------------------+
     */
    //------------------------------------------------------------------+
}