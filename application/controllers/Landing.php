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

	public function index($periode = null)
	{
		if (isset($_SESSION['id_mahasiswa'])) {
			redirect('landing/vote');
			exit;	
		}

		// for search
		if ($periode != null) 
		{
			$periode 			 = urldecode($periode);
			$periode 			 = $this->pemo->getPeriodeByPeriode($periode);
			$id_periode 		 = $periode['id_periode'];
			$data['row_periode'] = $periode; 
			$data['vote'] 		 = $this->vomo->getVoteByPeriodeResult($id_periode);

			if ($periode['status'] == "belum_selesai" && $periode['aktif'] == '1') 
			{
				redirect('landing/loginVote/' . $id_periode);
				exit;	
			}
		}
		elseif ($this->pemo->getCurrentPeriode())
		{
			if ($this->pemo->getCurrentPeriode()['status'] == "belum_selesai") 
			{
				$periode 			 = $this->pemo->getCurrentPeriode();
				$id_periode 		 = $periode['id_periode'];
				/*$data['row_periode'] = $periode; 
				$data['vote'] 		 = $this->vomo->getVoteByPeriodeResult($id_periode);*/
				redirect('landing/loginVote/' . $id_periode);
			}
			elseif ($this->pemo->getCurrentPeriode()['status'] == "sudah_selesai") 
			{
				$periode 			 = $this->pemo->getCurrentPeriode();
				$id_periode 		 = $periode['id_periode'];
				$data['row_periode'] = $periode; 
				$data['vote'] 		 = $this->vomo->getVoteByPeriodeResult($id_periode);
			}
		}

		if (isset($periode['periode'])) 
		{
			$data['title']			= 'Presma - ' . $periode['periode'];
		}
		else
		{
			$data['title']			= 'Presma';
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('landing/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function loginVote($id_periode = 0)
	{
		$periode = $this->pemo->getPeriodeById($id_periode);

		if (isset($_SESSION['id_mahasiswa'])) {
			redirect('landing/vote');	
		}

		if ($this->pemo->getCurrentPeriode()['status'] == "sudah_selesai")
		{
			redirect('landing');
		}

		$data['title']		= 'Masuk Vote | Periode ' . $periode['periode'];
		
		$this->form_validation->set_rules('nim', 'NIM', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('landing/login_vote', $data);
			$this->load->view('templates/footer', $data);  
		} else {
		    $this->lamo->loginVote($id_periode);
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
		$this->load->view('templates/header-vote', $data);
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

	public function afterVote($isi = '', $id_periode)
	{
		$isi = urldecode($isi);
		$this->session->set_flashdata('message-success', $isi);
		redirect('landing/loginVote/' . $id_periode);
	}
}