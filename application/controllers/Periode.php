<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periode extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'admo');
	}

	public function index()
	{
		$this->admo->checkLoginAdmin();
		
		$data['title']	= 'Periode';
		$this->load->view('templates/header-admin', $data);
		$this->load->view('periode/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}
}