<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    /*
      +--------------------------------------------------------------------+
      |----------------------Fungsi Load Tampilan--------------------------|
      +--------------------------------------------------------------------+
     */

    public function index() {
        $data['title'] = "Login Masuk Sistem";
        $this->load->view('login/layout/header', $data);
        $this->load->view('login/login');
        $this->load->view('login/layout/footer');
    }

//-------------------------------------------------------------------------+

    /*
      +--------------------------------------------------------------------+
      |---------------------- Function Logic & Method ---------------------|
      +--------------------------------------------------------------------+
     */
    // start here
    public function validasi() {
        $username = ucfirst($this->input->post('username'));
	$password = md5($this->input->post('token'));
        $perintah = $this->login_model->get_login($username, $password);
        if ($perintah->num_rows() == 1) {
            foreach ($perintah->result() as $data) {
                $sesi['id_akun']    = $data->id_akun;
                $sesi['username']   = $data->username;
                $sesi['status']     = $data->status;
                $sesi['id_akses']   = $data->id_akses;
                $sesi['validasi']   = TRUE;
                $this->session->set_userdata($sesi);
            }
        if($this->session->userdata('id_akses') == '1'){
            echo "<script>window.alert('Login Berhasil..!');</script>";
            redirect('surveyer', 'refresh');
	}
        elseif($this->session->userdata('id_akses') == '2'){
            echo "<script>window.alert('Login Berhasil..!');</script>";
            redirect('operator', 'refresh');
	}
	elseif($this->session->userdata('id_akses') == '3'){
            echo "<script>window.alert('Login Berhasil..!');</script>";
            redirect('admin', 'refresh');
	}
        }else{
        $this->session->set_flashdata('pesan',
                '<div id="card-alert" class="card red">
                      <div class="card-content white-text">
                        <p><i class="material-icons">error_outline</i>&nbsp; Username atau Password Salah</p>
                      </div>
                    </div>'
                );
            redirect('welcome');
	}
         
    }
    public function logout() {
        $this->session->sess_destroy();
        echo "<script>window.alert('Login Berhasil..!');</script>";
        redirect('welcome');
    }
  
//-------------------------------------------------------------------------+
}