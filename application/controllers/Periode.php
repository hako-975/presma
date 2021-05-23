<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periode extends CI_Controller 
{
	public function index()
	{
		$data['title']	= 'Periode';
		$this->load->view('templates/header-admin', $data);
		$this->load->view('periode/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}
}