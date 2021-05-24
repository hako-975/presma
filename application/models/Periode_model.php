<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periode_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Log_model', 'lomo');
		$this->load->model('Admin_model', 'admo');
	}

	public function getPeriode()
	{
		$this->db->order_by('periode', 'asc');
		return $this->db->get('periode')->result_array();
	}

	public function getPeriodeById($id)
	{
		return $this->db->get_where('periode', ['id_periode' => $id])->row_array();
	}

	public function addPeriode()
	{
		$periode = $this->input->post('dari_tahun', true) . ' - ' . $this->input->post('sampai_tahun', true);
		
		// cek periode sudah tersedia atau belum
		$checkPeriode = $this->db->get_where('periode', ['periode' => $periode])->row_array();
		
		if ($checkPeriode) 
		{
			$isi = 'Periode ' . $periode . ' sudah tersedia';
			$this->session->set_flashdata('message-failed', $isi);

			$id_user = $this->admo->getDataUserAdmin()['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect('periode');
			exit;
		}

		$data = [
			'periode' => $periode
		];

		$this->db->insert('periode', $data);
		$isi = 'Periode ' . $data['periode'] . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('periode');
	}

	public function editPeriode($id)
	{
		$periode_old = $this->getPeriodeById($id)['periode'];

		$periode_new = $this->input->post('dari_tahun', true) . ' - ' . $this->input->post('sampai_tahun', true);
		
		// cek periode sudah tersedia atau belum
		if ($periode_old != $periode_new)
		{
			$checkPeriode = $this->db->get_where('periode', ['periode' => $periode_new])->row_array();
			
			if ($checkPeriode) 
			{
				$isi = 'Periode ' . $periode_new . ' sudah tersedia';
				$this->session->set_flashdata('message-failed', $isi);

				$id_user = $this->admo->getDataUserAdmin()['id_user'];
				$this->lomo->addLog($isi, $id_user);
				redirect('periode');
				exit;
			}
		}

		$data = [
			'periode' => $periode_new,
			'status' => $this->input->post('status', true)
		];
		
		$status = explode('_', $data['status']);
		$status = implode(' ', $status);
		$status = ucwords(strtolower($status));

		$this->db->update('periode', $data, ['id_periode' => $id]);
		$isi = 'Periode ' . $periode_old . ' berhasil diubah menjadi ' . $periode_new . ' dengan status ' . $status;
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('periode');
	}

	public function removePeriode($id)
	{
		$periode = $this->getPeriodeById($id)['periode'];
		$this->db->delete('periode', ['id_periode' => $id]);
		$isi = 'Periode ' . $periode . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('periode');
	}
}
