<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller 
{
	public function index()
	{
		$data['title']	= 'Mahasiswa';
		$this->load->view('templates/header-admin', $data);
		$this->load->view('mahasiswa/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}
}