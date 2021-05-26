<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Rombel_model', 'remo');
		$this->load->model('Periode_model', 'pemo');
		$this->load->model('Mahasiswa_model', 'mamo');
		$this->load->model('Kandidat_model', 'kamo');
		$this->load->model('Vote_model', 'vomo');
		$this->load->model('Admin_model', 'admo');
	}

	public function index()
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Vote';
		$data['rombel']		= $this->romo->getRombel();
		$data['vote']		= $this->vomo->getVote();
		$data['periode']	= $this->pemo->getPeriode();
		$data['mahasiswa']	= $this->mamo->getMahasiswa();
		$data['kandidat']	= $this->kamo->getKandidat();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('id_mahasiswa', 'Mahasiswa', 'required|trim|is_unique[vote.id_mahasiswa]');
		$this->form_validation->set_rules('id_periode', 'Periode', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('vote/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->vomo->addVote();
		}
	}

	public function editVote($id)
	{
		$this->admo->checkLoginAdmin();
		
		$data['title']		= 'Vote';
		$data['rombel']		= $this->romo->getRombel();
		$data['vote']		= $this->vomo->getVote();
		$data['periode']	= $this->pemo->getPeriode();
		$data['mahasiswa']	= $this->mamo->getMahasiswa();
		$data['kandidat']	= $this->kamo->getKandidat();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('vote', 'Vote', 'required|trim');
		$this->form_validation->set_rules('id_mahasiswa', 'Mahasiswa', 'required|trim');
		$this->form_validation->set_rules('id_kandidat', 'Kandidat', 'required|trim');
		$this->form_validation->set_rules('id_periode', 'Periode', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('vote/index', $data);
			$this->load->view('templates/footer-admin', $data);
		}
		else
		{
			$this->vomo->editVote($id);
		}
	}

	public function removeVote($id)
	{
		$this->admo->checkLoginAdmin();
		
		$this->vomo->removeVote($id);
	}

	public function setFlashData($behavior)
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Vote';
		$data['rombel']		= $this->romo->getRombel();
		$data['vote']		= $this->vomo->getVote();
		$data['periode']	= $this->pemo->getPeriode();
		$data['mahasiswa']	= $this->mamo->getMahasiswa();
		$data['kandidat']	= $this->kamo->getKandidat();
		$data['dataUser']	= $this->admo->getDataUserAdmin();
		$data['behavior']	= $behavior;

		$this->form_validation->set_rules('id_mahasiswa', 'Mahasiswa', 'required|trim|is_unique[vote.id_mahasiswa]');
		$this->form_validation->set_rules('id_periode', 'Periode', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('vote/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->vomo->addVote();
		}
	}

	public function get_mahasiswa()
	{
		$this->load->view('vote/get_mahasiswa');
	}
}
