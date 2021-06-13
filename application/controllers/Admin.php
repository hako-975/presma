<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'admo');
		$this->load->model('Periode_model', 'pemo');
		$this->load->model('Vote_model', 'vomo');
	}

	public function index($periode = null)
	{
		$this->admo->checkLoginAdmin();

		$data['dataUser']	= $this->admo->getDataUserAdmin();
		$data['title']		= 'Dasbor';
		
		if ($this->pemo->getCurrentPeriode())
		{
			$periode 			 = $this->pemo->getCurrentPeriode();
			$id_periode 		 = $periode['id_periode'];
			$data['row_periode'] = $periode; 
			$data['vote'] 		 = $this->vomo->getVoteByPeriodeResult($id_periode);
		}
		else if ($periode)
		{
			$periode 			 = urldecode($periode);
			$periode 			 = $this->pemo->getPeriodeByPeriode($periode);
			$id_periode 		 = $periode['id_periode'];
			$data['row_periode'] = $periode; 
			$data['vote'] 		 = $this->vomo->getVoteByPeriodeResult($id_periode);
		}
		else
		{
			$periode 			 	 = $this->pemo->getLastPeriode();
			if ($periode != null) 
			{
				$id_periode 		 = $periode['id_periode'];
				$data['row_periode'] = $periode; 
				$data['vote'] 		 = $this->vomo->getVoteByPeriodeResult($id_periode);
			}
		}

		$this->load->view('templates/header-admin', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}

	public function profile()
	{
		$this->admo->checkLoginAdmin();

		$data['dataUser']	= $this->admo->getDataUserAdmin();
		$data['title']		= 'Profil - ' . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('old_password', 'Password Lama', 'required|trim');
		$this->form_validation->set_rules('new_password', 'Password Baru', 'required|trim|matches[new_password_verify]');
		$this->form_validation->set_rules('new_password_verify', 'Verifikasi Password Baru', 'required|trim|matches[new_password]');
		if ($this->form_validation->run() == false) {
		    $this->load->view('templates/header-admin', $data);
			$this->load->view('admin/profile', $data);
			$this->load->view('templates/footer-admin', $data);
		} else {
		    $this->admo->changePassword();
		}
	}

	public function editStatusPeriode($id_periode)
	{
		$this->admo->checkLoginAdmin();
		$this->pemo->editStatusPeriode($id_periode);
	}
}