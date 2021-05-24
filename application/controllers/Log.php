<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Log_model', 'lomo');
		$this->load->model('Admin_model', 'admo');
	}

	public function index()
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Riwayat';
		$data['log']		= $this->lomo->getLog();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->load->view('templates/header-admin', $data);
		$this->load->view('log/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}
}