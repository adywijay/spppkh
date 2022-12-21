<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bntuan extends CI_Controller {
	/*
	+--------------------------------------------------------------------+
	|----------------------Fungsi Load Tampilan--------------------------|
	+--------------------------------------------------------------------+
	*/
	public function index()
	{
		$data['title'] = "Manajemen Akun";
		$this->load->view('surveyer/layout/header',$data);
		$this->load->view('surveyer/layout/navigasi');
		$this->load->view('surveyer/konten/akun');
		$this->load->view('surveyer/layout/footer');
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
