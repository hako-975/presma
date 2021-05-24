<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rombel extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jurusan_model', 'jumo');
		$this->load->model('Rombel_model', 'romo');
		$this->load->model('Admin_model', 'admo');
	}

	public function index()
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Rombel';
		$data['rombel']		= $this->romo->getRombel();
		$data['jurusan']	= $this->jumo->getJurusan();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('semester', 'Semester', 'required|trim|is_natural_no_zero|max_length[3]');
		$this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('rombel/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->romo->addRombel();
		}
	}

	public function editRombel($id)
	{
		$this->admo->checkLoginAdmin();
		
		$data['title']		= 'Rombel';
		$data['rombel']		= $this->romo->getRombel();
		$data['jurusan']	= $this->jumo->getJurusan();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('semester', 'Semester', 'required|trim|is_natural_no_zero|max_length[3]');
		$this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('rombel/index', $data);
			$this->load->view('templates/footer-admin', $data);
		}
		else
		{
			$this->romo->editRombel($id);
		}
	}

	public function removeRombel($id)
	{
		$this->admo->checkLoginAdmin();
		
		$this->romo->removeRombel($id);
	}

	public function setFlashData($behavior)
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Rombel';
		$data['rombel']		= $this->romo->getRombel();
		$data['jurusan']	= $this->jumo->getJurusan();
		$data['dataUser']	= $this->admo->getDataUserAdmin();
		$data['behavior']	= $behavior;

		$this->form_validation->set_rules('semester', 'Semester', 'required|trim|is_natural_no_zero|max_length[3]');
		$this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('rombel/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->romo->addRombel();
		}
	}
}
