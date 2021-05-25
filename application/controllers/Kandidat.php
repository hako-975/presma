<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kandidat extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kandidat_model', 'kamo');
		$this->load->model('Admin_model', 'admo');
	}

	public function index()
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Kandidat';
		$data['kandidat']	= $this->kamo->getKandidat();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('nim', 'NIM', 'required|trim|is_unique[kandidat.nim]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('visi', 'Visi', 'required|trim');
		$this->form_validation->set_rules('misi', 'Misi', 'required|trim');
		$this->form_validation->set_rules('no_urut', 'No. Urut', 'required|trim|is_unique[kandidat.no_urut]');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('kandidat/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->kamo->addKandidat();
		}
	}

	public function editKandidat($id)
	{
		$this->admo->checkLoginAdmin();
		
		$data['title']		= 'Kandidat';
		$data['kandidat']	= $this->kamo->getKandidat();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('visi', 'Visi', 'required|trim');
		$this->form_validation->set_rules('misi', 'Misi', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('kandidat/index', $data);
			$this->load->view('templates/footer-admin', $data);
		}
		else
		{
			$this->kamo->editKandidat($id);
		}
	}

	public function removeKandidat($id)
	{
		$this->admo->checkLoginAdmin();
		
		$this->kamo->removeKandidat($id);
	}

	public function setFlashData($behavior)
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Kandidat';
		$data['kandidat']	= $this->kamo->getKandidat();
		$data['dataUser']	= $this->admo->getDataUserAdmin();
		$data['behavior']	= $behavior;

		$this->form_validation->set_rules('nim', 'NIM', 'required|trim|is_unique[kandidat.nim]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('visi', 'Visi', 'required|trim');
		$this->form_validation->set_rules('misi', 'Misi', 'required|trim');
		$this->form_validation->set_rules('no_urut', 'No. Urut', 'required|trim|is_unique[kandidat.no_urut]');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('kandidat/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->kamo->addKandidat();
		}
	}
}
