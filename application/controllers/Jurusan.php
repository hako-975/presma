<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jurusan_model', 'jumo');
		$this->load->model('Admin_model', 'admo');
	}

	public function index()
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Jurusan';
		$data['jurusan']	= $this->jumo->getJurusan();

		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim|is_unique[jurusan.jurusan]');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header-admin', $data);
			$this->load->view('jurusan/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} else {
		    $this->jumo->addJurusan();
		}
	}

	public function editJurusan($id)
	{
		$this->admo->checkLoginAdmin();

		$this->jumo->editJurusan($id);
	}

	public function removeJurusan($id)
	{
		$this->admo->checkLoginAdmin();
		
		$this->jumo->removeJurusan($id);
	}
}