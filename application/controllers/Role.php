<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller 
{
	public function index()
	{
		$data['title']	= 'Role';
		$this->load->view('templates/header-admin', $data);
		$this->load->view('role/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}
}