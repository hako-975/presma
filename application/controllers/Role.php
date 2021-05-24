<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Role_model', 'romo');
		$this->load->model('Admin_model', 'admo');
	}

	public function index()
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Role';
		$data['role']		= $this->romo->getRole();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('role', 'Role', 'required|trim|is_unique[role.role]');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('role/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->romo->addRole();
		}
	}

	public function editRole($id)
	{
		$this->admo->checkLoginAdmin();
		$data['title']		= 'Role';
		$data['role']		= $this->romo->getRole();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('role', 'Role', 'required|trim|is_unique[role.role]');
		if ($this->form_validation->run() == false)
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('role/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
			$this->romo->editRole($id);
		}
	}

	public function removeRole($id)
	{
		$this->admo->checkLoginAdmin();
		
		$this->romo->removeRole($id);
	}
}
