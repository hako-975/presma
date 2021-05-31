<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Vote_model', 'vomo');
		$this->load->model('Landing_model', 'lamo');
		$this->load->model('Periode_model', 'pemo');
		$this->load->model('Kandidat_model', 'kamo');
	}

	public function index()
	{
		if (isset($_SESSION['id_mahasiswa'])) {
			redirect('landing/vote');
			exit;	
		}
		
		$id_periode 		= $this->pemo->getCurrentPeriode()['id_periode'];
		$data['vote'] 		= $this->vomo->getVoteByPeriodeFinalResult($id_periode);
		$data['title']	= 'Presma';
		
		$this->load->view('templates/header', $data);
		$this->load->view('landing/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function loginVote()
	{
		if (isset($_SESSION['id_mahasiswa'])) {
			redirect('landing/vote');	
		}

		$data['title']		= 'Masuk Vote';
		
		$this->form_validation->set_rules('nim', 'NIM', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('landing/login_vote', $data);
			$this->load->view('templates/footer', $data);  
		} else {
		    $this->lamo->loginVote();
		}
	}

	public function vote()
	{
		if (!isset($_SESSION['id_mahasiswa'])) {
			redirect('landing/loginVote');
			exit;	
		}

		$data['title']		= 'Vote';
		$id_periode 		= $this->pemo->getCurrentPeriode()['id_periode'];
		$data['vote'] 		= $this->vomo->getVoteByPeriodeResult($id_periode);
		$data['kandidat'] 	= $this->kamo->getKandidatByIdPeriode($id_periode);
		$this->load->view('templates/header', $data);
		$this->load->view('landing/vote', $data);
		$this->load->view('templates/footer', $data);	
	}

	public function voteKandidat($id_kandidat, $id_mahasiswa, $id_periode)
	{
		if (!isset($_SESSION['id_mahasiswa'])) {
			redirect('landing/loginVote');
			exit;	
		}
		else
		{
			$this->lamo->voteKandidat($id_kandidat, $id_mahasiswa, $id_periode);
		}
	}

	public function afterVote($isi = '')
	{
		$isi = urldecode($isi);
		$this->session->set_flashdata('message-success', $isi);
		redirect('landing');
	}
}