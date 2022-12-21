<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
        if ($this->session->userdata('id_akses') != '3') {
            echo "<script>alert('Anda Tidak Mempunyai Hak Untuk Akses Sistem..!');</script>";
            redirect('welcome', 'refresh');
        }
    }

    /*
      +--------------------------------------------------------------------+
      |----------------------Fungsi Load Tampilan--------------------------|
      +--------------------------------------------------------------------+
     */
    /*

      public function index() {
      $data['title'] = ucfirst("halaman Login");
      $this->load->view('admin/layout/header_login', $data);
      $this->load->view('admin/konten/login');
      $this->load->view('admin/layout/footer_login');
      }
     * 
     */

    public function index() {
        $data['title'] = "Beranda";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/beranda');
        $this->load->view('admin/layout/footer');
    }

    public function logout() {
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
        $this->session->set_flashdata('pesan', '<div id="card-alert" class="card red">
                      <div class="card-content white-text">
                        <p><i class="material-icons">error_outline</i>&nbsp; Logout Sucess</p>
                      </div>
                    </div>'
        );
        redirect('welcome');
    }

    //--------------------CRUD AKUN---------------------------------------
    public function tampil_akun() {
        $data['admin'] = $this->akun_model->retrive_all();
        $data['title'] = "Manajemen Akun";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/akun');
        $this->load->view('admin/layout/footer');
    }

    public function edit_akun($id_akun) {
        $data['admin'] = $this->akun_model->get_akun($id_akun);
        $data['title'] = "Manajemen Akun";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/edit_akun');
        $this->load->view('admin/layout/footer');
    }

    public function tambah_akun() {
        $data['admin'] = $this->akses_model->retriveall_akses();
        $data['title'] = "Form Penambahan Akun";
        $this->form_validation->set_rules('nama', 'Atribut', 'required', 'rtrim');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Token');
        $this->form_validation->set_rules('retype_password', 'Retype', 'required');
        $this->form_validation->set_rules('no_telp', 'Nomor Telp', 'required|max_length[12]');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('id_akses', 'Akses', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/layout/header', $data);
            $this->load->view('admin/layout/navigasi');
            $this->load->view('admin/konten/add_akun');
            $this->load->view('admin/layout/footer');
        } else {
            $config['upload_path'] = './template/upload/profil/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['max_width'] = '20480';
            $config['max_height'] = '20480';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $errors = array('error' => $this->upload->display_errors());
                echo "<script>window.alert('Data Gagal Disimpan..!');window.location=('tambah_akun')</script>";
                $post_foto = 'noimage.png';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_foto = $_FILES['userfile']['name'];
            }
            $this->akun_model->insert_akun($post_foto);
            echo "<script>alert('Data Berhasil Disimpan..!');</script>";
            redirect('manajemen_akun', 'refresh');
        }
    }

    //--------------------CRUD HAK AKSES---------------------------------
    public function tampil_akses() {
        $data['title'] = "Data Akses";
        $this->form_validation->set_rules('nama_akses', 'Nama Hak Akses', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['admin'] = $this->akses_model->retriveall_akses();
            $this->load->view('admin/layout/header', $data);
            $this->load->view('admin/layout/navigasi');
            $this->load->view('admin/konten/add_akses');
            $this->load->view('admin/layout/footer');
        } else {
            $this->akses_model->insert_akses();
        }
    }

    //--------------------CRUD ATRIBUT-----------------------------------
    public function tampil_atribut() {
        $data['admin'] = $this->atribut_model->retriveall_atribut();
        $data['title'] = "Data Atribut";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_atribut');
        $this->load->view('admin/layout/footer');
    }

    public function tambah_atribut() {
        $this->form_validation->set_rules('atribut', 'Atribut', 'required');
        $this->form_validation->set_rules('nilai_atribut', 'Nilai_Atribut', 'required');
        $this->form_validation->set_rules('ket_nilai', 'Ket_nilai', 'required');
        $this->form_validation->set_rules('aktif', 'Aktif');
        $this->form_validation->set_rules('status');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = "Penambahan Data Atribut";
            $this->load->view('admin/layout/header', $data);
            $this->load->view('admin/layout/navigasi');
            $this->load->view('admin/konten/add_atribut');
            $this->load->view('admin/layout/footer');
        } else {
            $k = $this->atribut_model->insert_atribut();
            if ($k == TRUE) {
                echo "<script>alert('Data Berhasil Disimpan..!');</script>";
                redirect('admin/tampil_atribut');
            } else {
                echo "<script>window.alert('Data Gagal Disimpan..!');window.location=('surveyer/tambah_survey')</script>";
            }
        }
    }

    public function edit_atribut($id) {
        $data['admin'] = $this->atribut_model->get_atribut($id);
        $data['title'] = "Edit Data Atribut";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/edit_atribut');
        $this->load->view('admin/layout/footer');
    }

    //--------------------CRUD SURVEY------------------------------------
    public function tambah_survey() {
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
            $this->load->view('admin/layout/header', $data);
            $this->load->view('admin/layout/navigasi');
            $this->load->view('admin/konten/add_survey');
            $this->load->view('admin/layout/footer');
        } else {
            $perintah = $this->survey_model->insert_survey();
            if ($perintah == TRUE) {
                echo "<script>alert('Data Berhasil Disimpan..!');</script>";
                redirect('manajemen_master', 'refresh');
            } else {
                echo "<script>window.alert('Data Gagal Disimpan..!');window.location=('manajemen_master')</script>";
            }
        }
    }

    public function tampil_survey() {
        $data['title'] = "View Data Survey";
        $data['admin'] = $this->survey_model->retrive_all();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_survey');
        $this->load->view('admin/layout/footer');
    }

    public function detail_survey($id) {
        $data['title'] = "Halaman Detail Survey";
        $data['admin'] = $this->survey_model->get_detail_survey($id);
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_detail_survey');
        $this->load->view('admin/layout/footer');
    }

    public function detail_edit($id) {
        $data['title'] = "Halaman Detail Survey";
        $data['admin'] = $this->survey_model->get_edit($id);
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/edit_survey');
        $this->load->view('admin/layout/footer');
    }

    //--------------------CRUD MINING C45--------------------------------
    public function tampil_dtlatih() {
        $data['admin'] = $this->datalatih_model->retrive_dtlatih();
        $data['title'] = "View Data Latih";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/dtlatih');
        $this->load->view('admin/layout/footer');
    }

    public function tampil_dtuji() {
        $data['admin'] = $this->datauji_model->retrive_all();
        $data['title'] = "Data Uji";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_data_uji');
        $this->load->view('admin/layout/footer');
    }

    public function uji_akurasi() {
        $data['admin'] = $this->datauji_model->retrive_all();
        $data['title'] = "Hitung Akurasi";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_hitung_akurasi');
        $this->load->view('admin/layout/footer');
    }

    public function tampil_keputusan() {
        $data['admin'] = $this->mining_model->retrive_rule();
        $data['title'] = "View Phon Keputusan";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_keputusan');
        $this->load->view('admin/layout/footer');
    }

    public function mining() {
        $data['title'] = "proses Mining";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/proses_mining');
        $this->load->view('admin/layout/footer');
    }

    //--------------------CRUD PREDIKSI----------------------------------
    public function tampil_prediksi() {
        $data['title'] = "View Data Prediksi";
        $data['admin'] = $this->prediksi_model->retrive_all_prediksi();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_prediksi');
        $this->load->view('admin/layout/footer');
    }
    
    public function tampil_central() {
        $data['title'] = "View Central Data Prediksi";
        $data['admin'] = $this->prediksi_model->retrive_tanpa_syarat();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_central_prediksi');
        $this->load->view('admin/layout/footer');
    }

    public function tampil_hasil_prediksi() {
        $data['title'] = "View Data Hasil Prediksi";
        $data['admin'] = $this->prediksi_model->retrive_hasil_prediksi();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_hasil_prediksi');
        $this->load->view('admin/layout/footer');
    }
    
    public function tampil_layak() {
        $data['title'] = "View Data Layak Menerima";
        $data['admin'] = $this->prediksi_model->retrive_layak();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_layak_menerima');
        $this->load->view('admin/layout/footer'); 
    }
    
    public function tampil_cadangan() {
        $data['title'] = "View Data Cadangan Menerima";
        $data['admin'] = $this->prediksi_model->retrive_cadangan();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_cadangan_menerima');
        $this->load->view('admin/layout/footer'); 
    }
    

    //------------------------------------------------------------------+

    /*
      +-------------------------------------------------------------------+
      |---------------------- Function Logic & Method (FLM)---------------|
      +-------------------------------------------------------------------+
     */

    /*
      +-------------------------------------------------------------------+
      |---------------------- FLM ==== AKUN --------------------|
      +-------------------------------------------------------------------+
     */
    public function ubah_akun() {
        if (!empty($_FILES['userfile']['name'])) {
            $config['upload_path'] = './template/upload/profil/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['max_width'] = '20480';
            $config['max_height'] = '20480';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $errors = array('error' => $this->upload->display_errors());
                echo "<script>window.alert('Data Gagal Disimpan..!');window.location=('edit_akun')</script>";
                $post_foto = 'noimage.png';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_foto = $_FILES['userfile']['name'];
            }
            $this->akun_model->update_akun($post_foto);
        } else {
            $this->akun_model->edit_akunb();
        }
        redirect('admin/tampil_akun');
    }

    public function hapus_akun($id_akun) {
        $fungsi = $this->akun_model->delete_akun($id_akun);
        if ($fungsi == TRUE) {
            echo "<script>alert('Record Berhasil Dihapus..!');</script>";
            redirect('admin/tampil_akun', 'refresh');
        } else {
            echo "<script>window.alert('Record Gagal Dihapus..!');window.location=('admin/tampil_akun')</script>";
        }
    }

    public function kosongkan_akun() {
        $this->atribut_model->reset()->result;
    }

    /*
      +-------------------------------------------------------------------+
      |---------------------- FLM ==== HAK AKSES --------------------|
      +-------------------------------------------------------------------+
     */

    public function hapus_akses($id_akses) {
        $this->akses_model->delete_akses($id_akses);
    }

    public function kosongkan_akses() {
        $this->akses_model->reset();
    }

    /*
      +-------------------------------------------------------------------+
      |---------------------- FLM ==== ATRIBUT --------------------|
      +-------------------------------------------------------------------+
     */

    public function kosongkan_atribut() {
        $this->atribut_model->truncate_atribut()->result;
    }

    public function action_edit() {
        $fungsi = $this->atribut_model->update_atribut();
        if ($fungsi == TRUE) {
            echo "<script>alert('Record Berhasil Diupdate..!');</script>";
            redirect('admin/tampil_atribut', 'refresh');
        } else {
            echo "<script>window.alert('Record Gagal Diupdate..!');window.location=('admin/edit_atribut')</script>";
        }
    }

    public function hapus_atribut($id) {
        $this->atribut_model->delete_atribut($id);
    }

    /*
      +-------------------------------------------------------------------+
      |---------------------- FLM ==== SURVEY --------------------|
      +-------------------------------------------------------------------+
     */

    public function hapus_survey($id) {
        $perintah = $this->survey_model->delete_survey($id);
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Dihapus..!');</script>";
            redirect('admin/tampil_survey', 'refresh');
        } else {
            echo "<script>alert('Record Gagal Dihapus..!');</script>";
            redirect('admin/tampil_survey', 'refresh');
        }
    }

    public function kosongkan_survey() {
        $perintah = $this->survey_model->reset();
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Direset..!');</script>";
            redirect('admin/tampil_survey', 'refresh');
        } else {
            echo "<script>alert('Record Gagal Direset..!');</script>";
            redirect('admin/tampil_survey', 'refresh');
        }
    }

    public function edit_survey($id) {
        $perintah = $this->survey_model->update_survey($id);
        print_r($perintah);
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Diupdate..!');</script>";
            redirect('admin/tampil_survey', 'refresh');
        } else {
            echo "<script>alert('Record Gagal Diupdate..!');</script>";
            redirect('admin/tampil_survey', 'refresh');
        }
    }

    /*
      +-------------------------------------------------------------------+
      |---------------------- FLM ==== MINING C45 --------------------|
      +-------------------------------------------------------------------+
     */

//--------------------------------------------------------------------------------------------------------------------
    public function import_dtlatih() {
        $fileName = time() . $_FILES['file']['name'];

        $config['upload_path'] = FCPATH . './template/upload/dokumen'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file'))
            $this->upload->display_errors();

        $media = $this->upload->data('file');
        $inputFileName = $this->upload->data('full_path');

        try {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 1; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $data = array(
                /*
                "nik" => $rowData[0][0],
                "jml_art" => $rowData[0][1],
                "jml_keluarga" => $rowData[0][2],
                "sta_lahan" => $rowData[0][4],
                "sta_bangunan" => $rowData[0][5],
                "jns_lantai" => $rowData[0][6],
                "jns_dinding" => $rowData[0][7],
                "knds_dinding" => $rowData[0][8],
                "jns_atap" => $rowData[0][9],
                "knds_atap" => $rowData[0][10],
                "smb_air_minum" => $rowData[0][11],
                "cmdp_air_minum" => $rowData[0][12],
                "smb_penerangan" => $rowData[0][13],
                "dy_listrik" => $rowData[0][14],
                "bb_masak" => $rowData[0][15],
                "fasbab" => $rowData[0][16],
                "jns_kloset" => $rowData[0][17],
                "tp_akhir" => $rowData[0][18],
                "sta_art_usaha" => $rowData[0][19],
                "sta_kks" => $rowData[0][20],
                "sta_kip" => $rowData[0][21],
                "sta_bpjsm" => $rowData[0][22],
                "sta_jamsotek" => $rowData[0][23],
                "sta_asuransi_lain" => $rowData[0][24],
                "sta_rasta" => $rowData[0][25],
                "sta_kur" => $rowData[0][26],
                "sta_keberadaan_art" => $rowData[0][27],
                "keputusan_asli" => $rowData[0][28],
            );
                 * 
                 */
            
              "nik"                   => $rowData[0][0],
              "jml_art"               => $rowData[0][1],
              "jml_keluarga"          => $rowData[0][2],
              "sta_bangunan"          => $rowData[0][3],
              "sta_lahan"             => $rowData[0][4],
              "jns_lantai"            => $rowData[0][5],
              "jns_dinding"           => $rowData[0][6],
              "knds_dinding"          => $rowData[0][7],
              "jns_atap"              => $rowData[0][8],
              "knds_atap"             => $rowData[0][9],
              "smb_air_minum"         => $rowData[0][10],
              "cmdp_air_minum"        => $rowData[0][11],
              "smb_penerangan"        => $rowData[0][12],
              "dy_listrik"            => $rowData[0][13],
              "bb_masak"              => $rowData[0][14],
              "fasbab"                => $rowData[0][15],
              "jns_kloset"            => $rowData[0][16],
              "tp_akhir"              => $rowData[0][17],
              "sta_art_usaha"         => $rowData[0][18],
              "sta_kks"               => $rowData[0][19],
              "sta_kip"               => $rowData[0][20],
              "sta_kis"               => $rowData[0][21],
              "sta_bpjsm"             => $rowData[0][22],
              "sta_jamsotek"          => $rowData[0][23],
              "sta_asuransi_lain"     => $rowData[0][24],
              "sta_rasta"             => $rowData[0][25],
              "sta_kur"               => $rowData[0][26],
              "sta_keberadaan_art"    => $rowData[0][27],
              "keputusan_asli"        => $rowData[0][28]
              );
            $insert = $this->db->insert("tbl_data_latih", $data);
        }
        $cwd = getcwd();
        $excel_file_path = $cwd . "\\template\upload\dokumen";
        chdir($excel_file_path);
        unlink($inputFileName);
        chdir($cwd);
        redirect('dtlatih');
//        $fileName = time() . $_FILES['file']['name'];
//
//        $config['upload_path'] = FCPATH . './template/upload/dokumen'; //buat folder dengan nama assets di root folder
//        $config['file_name'] = $fileName;
//        $config['allowed_types'] = 'xls|xlsx|csv';
//        $config['max_size'] = 10000;
//
//        $this->load->library('upload');
//        $this->upload->initialize($config);
//
//        if (!$this->upload->do_upload('file'))
//            $this->upload->display_errors();
//
//        $media = $this->upload->data('file');
//        $inputFileName = $this->upload->data('full_path');
//
//        try {
//            $inputFileType = IOFactory::identify($inputFileName);
//            $objReader = IOFactory::createReader($inputFileType);
//            $objPHPExcel = $objReader->load($inputFileName);
//        } catch (Exception $e) {
//            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
//        }
//
//        $sheet = $objPHPExcel->getSheet(0);
//        $highestRow = $sheet->getHighestRow();
//        $highestColumn = $sheet->getHighestColumn();
//
//        for ($row = 3; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
//            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
//
//            $data = array(
//                "id" => $rowData[0][0],
//                "nik" => $rowData[0][1],
//                "jml_art" => $rowData[0][2],
//                "jml_keluarga" => $rowData[0][3],
//                "sta_lahan" => $rowData[0][4],
//                "sta_bangunan" => $rowData[0][5],
//                "jns_lantai" => $rowData[0][6],
//                "jns_dinding" => $rowData[0][7],
//                "knds_dinding" => $rowData[0][8],
//                "jns_atap" => $rowData[0][9],
//                "knds_atap" => $rowData[0][10],
//                "smb_air_minum" => $rowData[0][11],
//                "cmdp_air_minum" => $rowData[0][12],
//                "smb_penerangan" => $rowData[0][13],
//                "dy_listrik" => $rowData[0][14],
//                "bb_masak" => $rowData[0][15],
//                "fasbab" => $rowData[0][16],
//                "jns_kloset" => $rowData[0][17],
//                "tp_akhir" => $rowData[0][18],
//                "sta_art_usaha" => $rowData[0][19],
//                "sta_kks" => $rowData[0][20],
//                "sta_kip" => $rowData[0][21],
//                "sta_bpjsm" => $rowData[0][22],
//                "sta_jamsotek" => $rowData[0][23],
//                "sta_asuransi_lain" => $rowData[0][24],
//                "sta_rasta" => $rowData[0][25],
//                "sta_kur" => $rowData[0][26],
//                "sta_keberadaan_art" => $rowData[0][27],
//                "keputusan_asli" => $rowData[0][28],
//            );
            /*
              "nik"                   => $rowData[0][0],
              "jml_art"               => $rowData[0][1],
              "jml_keluarga"          => $rowData[0][2],
              "sta_lahan"             => $rowData[0][3],
              "sta_bangunan"          => $rowData[0][4],
              "jns_lantai"            => $rowData[0][5],
              "jns_dinding"           => $rowData[0][6],
              "knds_dinding"          => $rowData[0][7],
              "jns_atap"              => $rowData[0][8],
              "knds_atap"             => $rowData[0][9],
              "smb_air_minum"         => $rowData[0][10],
              "cmdp_air_minum"        => $rowData[0][11],
              "smb_penerangan"        => $rowData[0][12],
              "dy_listrik"            => $rowData[0][13],
              "bb_masak"              => $rowData[0][14],
              "fasbab"                => $rowData[0][15],
              "jns_kloset"            => $rowData[0][16],
              "tp_akhir"              => $rowData[0][17],
              "sta_art_usaha"         => $rowData[0][18],
              "sta_kks"               => $rowData[0][19],
              "sta_kip"               => $rowData[0][20],
              "sta_bpjsm"             => $rowData[0][21],
              "sta_jamsotek"          => $rowData[0][22],
              "sta_asuransi_lain"     => $rowData[0][23],
              "sta_rasta"             => $rowData[0][24],
              "sta_kur"               => $rowData[0][25],
              "sta_keberadaan_art"    => $rowData[0][26],
              "keputusan_asli"        => $rowData[0][27]
              );
             * 
             */
//            $insert = $this->db->insert("tbl_data_latih", $data);
//        }
//        $cwd = getcwd();
//        $excel_file_path = $cwd . "\\template\upload\dokumen";
//        chdir($excel_file_path);
//        unlink($inputFileName);
//        chdir($cwd);
//        redirect('admin/tampil_dtlatih');
    }

    public function cek_pra_ujirule() {
        $db = $this->datauji_model->jml_data();
        if ($db <= 0) {
            echo "<script>alert('Data Uji Kosong !!! Silahkan Import Data Uji..!');</script>";
            redirect('dtuji', 'refresh');
        } else {
            redirect('akurasi', 'refresh');
        }
    }

    public function reset_data_uji() {
        $perintah = $this->datauji_model->truncate_dtuji();
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Direset..!');</script>";
            redirect('dtuji', 'refresh');
        } else {
            echo "<script>alert('Record Gagal Direset..!');</script>";
            redirect('dtuji', 'refresh');
        }
    }

    public function import_dtuji() {
        $fileName = time() . $_FILES['file']['name'];

        $config['upload_path'] = FCPATH . './template/upload/dokumen'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file'))
            $this->upload->display_errors();

        $media = $this->upload->data('file');
        $inputFileName = $this->upload->data('full_path');

        try {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 1; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $data = array(
                /*
                "nik" => $rowData[0][0],
                "jml_art" => $rowData[0][1],
                "jml_keluarga" => $rowData[0][2],
                "sta_lahan" => $rowData[0][4],
                "sta_bangunan" => $rowData[0][5],
                "jns_lantai" => $rowData[0][6],
                "jns_dinding" => $rowData[0][7],
                "knds_dinding" => $rowData[0][8],
                "jns_atap" => $rowData[0][9],
                "knds_atap" => $rowData[0][10],
                "smb_air_minum" => $rowData[0][11],
                "cmdp_air_minum" => $rowData[0][12],
                "smb_penerangan" => $rowData[0][13],
                "dy_listrik" => $rowData[0][14],
                "bb_masak" => $rowData[0][15],
                "fasbab" => $rowData[0][16],
                "jns_kloset" => $rowData[0][17],
                "tp_akhir" => $rowData[0][18],
                "sta_art_usaha" => $rowData[0][19],
                "sta_kks" => $rowData[0][20],
                "sta_kip" => $rowData[0][21],
                "sta_bpjsm" => $rowData[0][22],
                "sta_jamsotek" => $rowData[0][23],
                "sta_asuransi_lain" => $rowData[0][24],
                "sta_rasta" => $rowData[0][25],
                "sta_kur" => $rowData[0][26],
                "sta_keberadaan_art" => $rowData[0][27],
                "keputusan_asli" => $rowData[0][28],
            );
                 * 
                 */
            
              "nik"                   => $rowData[0][0],
              "jml_art"               => $rowData[0][1],
              "jml_keluarga"          => $rowData[0][2],
              "sta_bangunan"          => $rowData[0][3],
              "sta_lahan"             => $rowData[0][4],
              "jns_lantai"            => $rowData[0][5],
              "jns_dinding"           => $rowData[0][6],
              "knds_dinding"          => $rowData[0][7],
              "jns_atap"              => $rowData[0][8],
              "knds_atap"             => $rowData[0][9],
              "smb_air_minum"         => $rowData[0][10],
              "cmdp_air_minum"        => $rowData[0][11],
              "smb_penerangan"        => $rowData[0][12],
              "dy_listrik"            => $rowData[0][13],
              "bb_masak"              => $rowData[0][14],
              "fasbab"                => $rowData[0][15],
              "jns_kloset"            => $rowData[0][16],
              "tp_akhir"              => $rowData[0][17],
              "sta_art_usaha"         => $rowData[0][18],
              "sta_kks"               => $rowData[0][19],
              "sta_kip"               => $rowData[0][20],
              "sta_kis"               => $rowData[0][21],
              "sta_bpjsm"             => $rowData[0][22],
              "sta_jamsotek"          => $rowData[0][23],
              "sta_asuransi_lain"     => $rowData[0][24],
              "sta_rasta"             => $rowData[0][25],
              "sta_kur"               => $rowData[0][26],
              "sta_keberadaan_art"    => $rowData[0][27],
              "keputusan_asli"        => $rowData[0][28]
              );
            $insert = $this->db->insert("tbl_data_uji", $data);
        }
        $cwd = getcwd();
        $excel_file_path = $cwd . "\\template\upload\dokumen";
        chdir($excel_file_path);
        unlink($inputFileName);
        chdir($cwd);
        redirect('dtuji');
//        $fileName = time() . $_FILES['file']['name'];
//
//        $config['upload_path'] = FCPATH . './template/upload/dokumen'; //buat folder dengan nama assets di root folder
//        $config['file_name'] = $fileName;
//        $config['allowed_types'] = 'xls|xlsx|csv';
//        $config['max_size'] = 10000;
//
//        $this->load->library('upload');
//        $this->upload->initialize($config);
//
//        if (!$this->upload->do_upload('file')) {
//            $this->upload->display_errors();
//        } else {
//
//            $data_upload = $this->upload->data();
//
//            $excelreader = new PHPExcel_Reader_Excel2007();
//            $loadexcel = $excelreader->load('./template/upload/dokumen/' . $data_upload['file_name']); // Load file yang telah diupload ke folder excel
//            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
//            $data = array();
//            $numrow = 1;
//            foreach ($sheet as $row) {
//                if ($numrow > 1) {
//                    array_push($data, array(
//                        'nik' => $row['A'],
//                        'jml_art' => $row['B'],
//                        'jml_keluarga' => $row['C'],
//                        'sta_bangunan' => $row['D'],
//                        'sta_lahan' => $row['E'],
//                        'jns_lantai' => $row['F'],
//                        'jns_dinding' => $row['G'],
//                        'knds_dinding' => $row['H'],
//                        'jns_atap' => $row['I'],
//                        'knds_atap' => $row['J'],
//                        'smb_air_minum' => $row['K'],
//                        'cmdp_air_minum' => $row['L'],
//                        'smb_penerangan' => $row['M'],
//                        'dy_listrik' => $row['N'],
//                        'bb_masak' => $row['O'],
//                        'fasbab' => $row['P'],
//                        'jns_kloset' => $row['Q'],
//                        'tp_akhir' => $row['R'],
//                        'sta_art_usaha' => $row['S'],
//                        'sta_kks' => $row['T'],
//                        'sta_kip' => $row['U'],
//                        'sta_kis' => $row['V'],
//                        'sta_bpjsm' => $row['W'],
//                        'sta_jamsotek' => $row['X'],
//                        'sta_asuransi_lain' => $row['Y'],
//                        'sta_rasta' => $row['Z'],
//                        'sta_kur' => $row['AA'],
//                        'sta_keberadaan_art' => $row['AB'],
//                        'keputusan_asli' => $row['AC'],
//                            )
//                    );
//                }
//                $numrow++;
//            }
//            unlink(FCPATH . ('./template/upload/dokumen/' . $data_upload['file_name']));
//            $perintah = $this->db->insert_batch('tbl_data_uji', $data);
//            if ($perintah == TRUE) {
//                echo "<b><script>alert('Data Berhasil Disimpan..!');</script></b>";
//                redirect('admin/tampil_dtuji', 'refresh');
//            } else {
//                echo "<script>window.alert('Data Gagal Disimpan..!');window.location=('admin/tampil_dtuji')</script>";
//            }
//        }
    }

    public function detail_keputusan() {
        $data['title'] = "Detail Keputusan";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/view_detail_tree');
        $this->load->view('admin/layout/footer');
    }

    public function reset_keputusan() {
        $perintah = $this->keputusan_model->truncate_keputusan();
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Direset..!');</script>";
            redirect('keputusan', 'refresh');
        } else {
            echo "<script>alert('Record Gagal Direset..!');</script>";
            redirect('keputusan', 'refresh');
        }
    }

    public function upload_file() {
        $fileName = time() . $_FILES['file']['name'];

        $config['upload_path'] = FCPATH . './template/upload/dokumen'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            $this->upload->display_errors();
        } else {

            $data_upload = $this->upload->data();

            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('./template/upload/dokumen/' . $data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data = array();
            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    array_push($data, array(
                        'nik' => $row['A'],
                        'jml_art' => $row['B'],
                        'jml_keluarga' => $row['C'],
                        'sta_bangunan' => $row['D'],
                        'sta_lahan' => $row['E'],
                        'jns_lantai' => $row['F'],
                        'jns_dinding' => $row['G'],
                        'knds_dinding' => $row['H'],
                        'jns_atap' => $row['I'],
                        'knds_atap' => $row['J'],
                        'smb_air_minum' => $row['K'],
                        'cmdp_air_minum' => $row['L'],
                        'smb_penerangan' => $row['M'],
                        'dy_listrik' => $row['N'],
                        'bb_masak' => $row['O'],
                        'fasbab' => $row['P'],
                        'jns_kloset' => $row['Q'],
                        'tp_akhir' => $row['R'],
                        'sta_art_usaha' => $row['S'],
                        'sta_kks' => $row['T'],
                        'sta_kip' => $row['U'],
                        'sta_kiS' => $row['V'],
                        'sta_bpjsm' => $row['W'],
                        'sta_jamsotek' => $row['X'],
                        'sta_asuransi_lain' => $row['Y'],
                        'sta_rasta' => $row['Z'],
                        'sta_kur' => $row['AA'],
                        'sta_keberadaan_art' => $row['AB'],
                        'keputusan_asli' => $row['AC'],
                            )
                    );
                }
                $numrow++;
            }
            unlink(FCPATH . ('./template/upload/dokumen/' . $data_upload['file_name']));
            $perintah = $this->db->insert_batch('tbl_data_latih', $data);
            if ($perintah == TRUE) {
                echo "<b><script>alert('Data Berhasil Disimpan..!');</script></b>";
                redirect('admin/tampil_dtlatih', 'refresh');
            } else {
                echo "<script>window.alert('Data Gagal Disimpan..!');window.location=('admin/tampil_dtlatih')</script>";
            }
        }
    }

//        $fileName = time() . $_FILES['file']['name'];
//        $config['upload_path'] = FCPATH . './template/upload/dokumen'; //buat folder dengan nama assets di root folder
//        $config['file_name'] = $fileName;
//        $config['allowed_types'] = 'xls|xlsx|csv';
//        $config['max_size'] = 10000;
//
//        $this->load->library('upload');
//        $this->upload->initialize($config);
//
//        if (!$this->upload->do_upload('file')){
//            $this->upload->display_errors();
//        } else {
//            $data = $this->upload->data();
//            @chmod($data['full_path]'],0777);
//            $this->load->library('Spreadsheet_Excel_Reader');
//            $this->spreadsheet_sxcel_reader->setOutputEncoding('CP1251');        
//            $this->spreadsheet_excel_reader->read($data['full_path]']);
//            error_reporting(E_ALL xor E_NOTICE);
//            $excel = array();
//            $sheets = $this->spreadsheet_excel_reader->sheets[0];
//            for($i=1;$i<=$sheets['numRows']; $i++){
//                $excel['id'] = $sheets['cells'][$i][1];
//                $excel['nik'] = $sheets['cells'][$i][2];
//                $excel['jml_art'] = $sheets['cells'][$i][3];
//                $excel['jml_keluarga'] = $sheets['cells'][$i][4];
//                $excel['sta_lahan'] = $sheets['cells'][$i][5];
//                $excel['sta_bangunan'] = $sheets['cells'][$i][6];
//                $excel['jns_lantai'] = $sheets['cells'][$i][7];
//                $excel['jns_dinding'] = $sheets['cells'][$i][8];
//                $excel['knds_dinding'] = $sheets['cells'][$i][9];
//                $excel['jns_atap'] = $sheets['cells'][$i][10];
//                $excel['knds_atap'] = $sheets['cells'][$i][11];
//                $excel['smb_air_minum'] = $sheets['cells'][$i][12];
//                $excel['cmdp_air_minum'] = $sheets['cells'][$i][13];
//                $excel['smb_penerangan'] = $sheets['cells'][$i][14];
//                $excel['dy_listrik'] = $sheets['cells'][$i][15];
//                $excel['bb_masak'] = $sheets['cells'][$i][16];
//                $excel['fasbab'] = $sheets['cells'][$i][17];
//                $excel['jns_kloset'] = $sheets['cells'][$i][18];
//                $excel['tp_akhir'] = $sheets['cells'][$i][19];
//                $excel['sta_art_usaha'] = $sheets['cells'][$i][20];
//                $excel['sta_kks'] = $sheets['cells'][$i][21];
//                $excel['sta_kip'] = $sheets['cells'][$i][22];
//                $excel['sta_bpjsm'] = $sheets['cells'][$i][23];
//                $excel['sta_jamsotek'] = $sheets['cells'][$i][24];
//                $excel['sta_asuransi_lain'] = $sheets['cells'][$i][25];
//                $excel['sta_rasta'] = $sheets['cells'][$i][26];
//                $excel['sta_kur'] = $sheets['cells'][$i][27];
//                $excel['sta_keberadaan_art'] = $sheets['cells'][$i][28];
//                $excel['keputusan_asli'] = $sheets['cells'][$i][29];
//                $this->db->insert("tbl_data_latih", $excel);
//            }
//            echo 'berhasil';
//        } 
//
    /*
      +-------------------------------------------------------------------+
      |---------------------- FLM ==== PREDIKSI --------------------|
      +-------------------------------------------------------------------+
     */
    //------------------------------------------------------------------+
    public function reset_prediksi() {
        $perintah = $this->prediksi_model->truncate_prediksi();
        if ($perintah == TRUE) {
            echo "<script>alert('Record Berhasil Direset..!');</script>";
            redirect('central', 'refresh');
        } else {
            echo "<script>alert('Record Gagal Direset..!');</script>";
            redirect('central', 'refresh');
        }
    }
    
    public function cetak_prediksi($kondisi) {
        $this->prediksi_model->cetak($kondisi);
        
    }
    
    public function cetak_layak($kondisi) {
        $this->prediksi_model->print_layak($kondisi);
    }
    
    public function cetak_cadangan($kondisi) {
        $this->prediksi_model->cetak($kondisi);
    }

    public function tampil_atb() {
        //$data['admin'] = $this->tes_model->retrive_atribut();
        $data['title'] = "View Data Latih";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/navigasi');
        $this->load->view('admin/konten/add_atb');
        $this->load->view('admin/layout/footer');
    }
    
    public function hapus_prediksi($id) {
        return $this->prediksi_model->delete_prediksi($id);
    }

    public function cek() {
        $fileName = time() . $_FILES['file']['name'];

        $config['upload_path'] = FCPATH . './template/upload/dokumen'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            $this->upload->display_errors();
        } else {

            $data_upload = $this->upload->data();

            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('./template/upload/dokumen/' . $data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data = array();
            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    array_push($data, array(
                        'atribut' => $row['A'],
                        'nilai_atribut' => $row['B'],
                            )
                    );
                }
                $numrow++;
            }
            unlink(FCPATH . ('./template/upload/dokumen/' . $data_upload['file_name']));
            $perintah = $this->db->insert_batch('tbl_atribut', $data);
            if ($perintah == TRUE) {
                echo "<b><script>alert('Data Berhasil Disimpan..!');</script></b>";
                redirect('admin/tampil_atb', 'refresh');
            } else {
                echo "<script>window.alert('Data Gagal Disimpan..!');window.location=('admin/tampil_atb')</script>";
            }
        }
    }
}
