<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kandidat extends CI_Controller 
{
	public function index()
	{
		$data['title']	= 'Kandidat';
		$this->load->view('templates/header-admin', $data);
		$this->load->view('kandidat/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}
}