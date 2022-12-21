<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	/*
	+--------------------------------------------------------------------+
	|----------------------Fungsi Load Tampilan--------------------------|
	+--------------------------------------------------------------------+
	*/
	public function index()
	{
		$data['title'] = "Beranda";
		$this->load->view('surveyer/layout/header',$data);
		$this->load->view('surveyer/layout/navigasi');
		$this->load->view('surveyer/konten/beranda');
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
