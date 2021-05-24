<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periode extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Periode_model', 'pemo');
		$this->load->model('Admin_model', 'admo');
	}

	public function index()
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Periode';
		$data['periode']	= $this->pemo->getPeriode();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('dari_tahun', 'Dari Tahun', 'required|trim|less_than_equal_to[' . $this->input->post('sampai_tahun', true) . ']');
		$this->form_validation->set_rules('sampai_tahun', 'Sampai Tahun', 'required|trim|greater_than_equal_to[' . $this->input->post('dari_tahun', true) . ']');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('periode/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->pemo->addPeriode();
		}
	}

	public function editPeriode($id)
	{
		$this->admo->checkLoginAdmin();
		
		$data['title']		= 'Periode';
		$data['periode']	= $this->pemo->getPeriode();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('dari_tahun', 'Dari Tahun', 'required|trim|less_than_equal_to[' . $this->input->post('sampai_tahun', true) . ']');
		$this->form_validation->set_rules('sampai_tahun', 'Sampai Tahun', 'required|trim|greater_than_equal_to[' . $this->input->post('dari_tahun', true) . ']');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('periode/index', $data);
			$this->load->view('templates/footer-admin', $data);
		}
		else
		{
			$this->pemo->editPeriode($id);
		}
	}

	public function removePeriode($id)
	{
		$this->admo->checkLoginAdmin();
		
		$this->pemo->removePeriode($id);
	}

	public function setFlashData($behavior)
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Periode';
		$data['periode']	= $this->pemo->getPeriode();
		$data['dataUser']	= $this->admo->getDataUserAdmin();
		$data['behavior']	= $behavior;

		$this->form_validation->set_rules('dari_tahun', 'Dari Tahun', 'required|trim|less_than_equal_to[' . $this->input->post('sampai_tahun', true) . ']');
		$this->form_validation->set_rules('sampai_tahun', 'Sampai Tahun', 'required|trim|greater_than_equal_to[' . $this->input->post('dari_tahun', true) . ']');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('periode/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->pemo->addPeriode();
		}
	}
}
