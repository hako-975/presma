<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rombel extends CI_Controller 
{
	public function index()
	{
		$data['title']	= 'Rombel';
		$this->load->view('templates/header-admin', $data);
		$this->load->view('rombel/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}
}