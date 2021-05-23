<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller 
{
	public function index()
	{
		$data['title']	= 'Vote';
		$this->load->view('templates/header-admin', $data);
		$this->load->view('vote/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}
}