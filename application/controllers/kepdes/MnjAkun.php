<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MnjAkun extends CI_Controller {
	/*
	+--------------------------------------------------------------------+
	|----------------------Fungsi Load Tampilan--------------------------|
	+--------------------------------------------------------------------+
	*/
	public function index()
	{
		$data['title'] = "Manajemen Akun";
		$this->load->view('kepdes/layout/header',$data);
		$this->load->view('kepdes/layout/navigasi');
		$this->load->view('kepdes/konten/akun');
		$this->load->view('kepdes/layout/footer');
	}
//------------------------------------------------------------------------+

	/*
	+--------------------------------------------------------------------+
	|---------------------- Function Logic & Method ---------------------|
	+--------------------------------------------------------------------+
	*/
	// start here
	
//------------------------------------------------------------------------+
	
}
