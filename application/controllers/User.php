<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'usmo');
		$this->load->model('Admin_model', 'admo');
		$this->load->model('Role_model', 'romo');
	}

	public function index()
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Pengguna';
		$data['user']		= $this->usmo->getUser();
		$data['role']		= $this->romo->getRole();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_verify]');
		$this->form_validation->set_rules('password_verify', 'Verifikasi Password', 'required|matches[password]');
		$this->form_validation->set_rules('id_role', 'Jabatan', 'required');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer-admin', $data);
		}
		else 
		{
		    $this->usmo->addUser();
		}
	}

	public function editUser($id)
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Pengguna';
		$data['user']		= $this->usmo->getUser();
		$data['role']		= $this->romo->getRole();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		// $this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('id_role', 'Jabatan', 'required');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer-admin', $data);
		}
		else 
		{
			$this->usmo->editUser($id);
		}
	}

	public function removeUser($id)
	{
		$this->admo->checkLoginAdmin();
		
		$this->usmo->removeUser($id);
	}

	public function setFlashData($behavior)
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Pengguna';
		$data['user']		= $this->usmo->getUser();
		$data['role']		= $this->romo->getRole();
		$data['dataUser']	= $this->admo->getDataUserAdmin();
		$data['behavior']	= $behavior;

		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_verify]');
		$this->form_validation->set_rules('password_verify', 'Verifikasi Password', 'required|matches[password]');
		$this->form_validation->set_rules('id_role', 'Jabatan', 'required');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer-admin', $data);
		}
		else 
		{
		    $this->usmo->addUser();
		}
	}
}
