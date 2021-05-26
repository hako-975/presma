<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Rombel_model', 'romo');
		$this->load->model('Mahasiswa_model', 'mamo');
		$this->load->model('Admin_model', 'admo');
	}

	public function index()
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Mahasiswa';
		$data['mahasiswa']	= $this->mamo->getMahasiswa();
		$data['rombel']		= $this->romo->getRombel();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('nim', 'NIM', 'required|trim|is_unique[mahasiswa.nim]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('id_rombel', 'Rombel', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('mahasiswa/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->mamo->addMahasiswa();
		}
	}

	public function editMahasiswa($id)
	{
		$this->admo->checkLoginAdmin();
		
		$data['title']		= 'Mahasiswa';
		$data['mahasiswa']	= $this->mamo->getMahasiswa();
		$data['rombel']		= $this->romo->getRombel();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('nim', 'NIM', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('id_rombel', 'Rombel', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('mahasiswa/index', $data);
			$this->load->view('templates/footer-admin', $data);
		}
		else
		{
			$this->mamo->editMahasiswa($id);
		}
	}

	public function removeMahasiswa($id)
	{
		$this->admo->checkLoginAdmin();
		
		$this->mamo->removeMahasiswa($id);
	}

	public function setFlashData($behavior)
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Mahasiswa';
		$data['mahasiswa']	= $this->mamo->getMahasiswa();
		$data['rombel']		= $this->romo->getRombel();
		$data['dataUser']	= $this->admo->getDataUserAdmin();
		$data['behavior']	= $behavior;

		$this->form_validation->set_rules('nim', 'NIM', 'required|trim|is_unique[mahasiswa.nim]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('id_rombel', 'Rombel', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('mahasiswa/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->mamo->addMahasiswa();
		}
	}
}
