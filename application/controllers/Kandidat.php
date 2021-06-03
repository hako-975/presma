<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kandidat extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Periode_model', 'pemo');
		$this->load->model('Kandidat_model', 'kamo');
		$this->load->model('Admin_model', 'admo');
	}

	public function index()
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Kandidat';
		$data['periode']	= $this->pemo->getPeriode();
		$data['kandidat']	= $this->kamo->getKandidat();
		$data['dataUser']	= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('nim', 'NIM', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('visi', 'Visi', 'required|trim');
		$this->form_validation->set_rules('misi', 'Misi', 'required|trim');
		$this->form_validation->set_rules('no_urut', 'No. Urut', 'required|trim|is_natural_no_zero');
		$this->form_validation->set_rules('id_periode', 'Periode', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('kandidat/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->kamo->addKandidat();
		}
	}

	public function periode($periode = null)
	{
		$this->admo->checkLoginAdmin();
		
		$periode = urldecode($periode);

		if ($this->db->get_where('periode', ['periode' => $periode])->row_array() == null) 
		{
			redirect('kandidat');
		}
		elseif ($periode == null)
		{
			redirect('kandidat');
		}

		$id_periode = $this->pemo->getPeriodeByPeriode($periode)['id_periode'];

		$data['title']				= 'Kandidat ' . $periode;
		$data['kandidat_periode']	= $this->kamo->getKandidatByPeriodeResult($id_periode);
		$data['row_periode']		= $this->pemo->getPeriodeByPeriode($periode);
		$data['dataUser']			= $this->admo->getDataUserAdmin();

		$this->form_validation->set_rules('nim', 'NIM', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('visi', 'Visi', 'required|trim');
		$this->form_validation->set_rules('misi', 'Misi', 'required|trim');
		$this->form_validation->set_rules('no_urut', 'No. Urut', 'required|trim|is_natural_no_zero');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('kandidat/periode', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->kamo->addKandidat($url_periode = $periode);
		}
	}

	public function editKandidat($id, $url_periode = null)
	{
		$this->admo->checkLoginAdmin();
		
		$data['title']		= 'Kandidat';
		$data['periode']	= $this->pemo->getPeriode();
		$data['kandidat']	= $this->kamo->getKandidat();
		$data['dataUser']	= $this->admo->getDataUserAdmin();
		
		$this->form_validation->set_rules('nim', 'NIM', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('visi', 'Visi', 'required|trim');
		$this->form_validation->set_rules('misi', 'Misi', 'required|trim');
		$this->form_validation->set_rules('no_urut', 'No. Urut', 'required|trim|is_natural_no_zero');
		$this->form_validation->set_rules('id_periode', 'Periode', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('kandidat/index', $data);
			$this->load->view('templates/footer-admin', $data);
		}
		else
		{
			$this->kamo->editKandidat($id, $url_periode);
		}
	}

	public function removeKandidat($id, $url_periode = null)
	{
		$this->admo->checkLoginAdmin();
		
		$this->kamo->removeKandidat($id, $url_periode);
	}

	public function setFlashData($behavior, $url_periode = null)
	{
		$this->admo->checkLoginAdmin();

		$data['title']		= 'Kandidat';
		$data['periode']	= $this->pemo->getPeriode();
		$data['kandidat']	= $this->kamo->getKandidat();
		$data['dataUser']	= $this->admo->getDataUserAdmin();
		$data['behavior']	= $behavior;

		$this->form_validation->set_rules('nim', 'NIM', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('visi', 'Visi', 'required|trim');
		$this->form_validation->set_rules('misi', 'Misi', 'required|trim');
		$this->form_validation->set_rules('no_urut', 'No. Urut', 'required|trim|is_natural_no_zero');
		$this->form_validation->set_rules('id_periode', 'Periode', 'required|trim');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('templates/header-admin', $data);
			$this->load->view('kandidat/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} 
		else 
		{
		    $this->kamo->addKandidat($url_periode);
		}
	}
}
