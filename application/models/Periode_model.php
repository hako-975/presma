<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periode_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Log_model', 'lomo');
		$this->load->model('Admin_model', 'admo');
		$this->load->model('Mahasiswa_model', 'mamo');
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

	public function getPeriodeByPeriode($periode)
	{
		return $this->db->get_where('periode', ['periode' => $periode])->row_array();
	}

	public function getCurrentPeriode()
	{
		$this->db->order_by('periode', 'asc');
		return $this->db->get_where('periode', ['aktif' => '1'])->row_array();
	}
	public function getLastPeriode()
	{
		$this->db->order_by('periode', 'desc');
		return $this->db->get('periode')->row_array();
	}

	public function addPeriode()
	{
		$dataUser = $this->admo->getDataUserAdmin();
		
		$mahasiswa = $this->mamo->getMahasiswa();

		// cek ada mahasiswa atau tidak
		if ($mahasiswa == false)
		{
			$isi = 'Isi Mahasiswa terlebih dahulu';
			$this->session->set_flashdata('message-failed', $isi);

			$id_user = $dataUser['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect('periode');
			exit;
		}

		$periode = $this->input->post('dari_tahun', true) . ' - ' . $this->input->post('sampai_tahun', true);
		
		$this->admo->userPrivilegeTamu('periode', ' (menambahkan periode ' . $periode . ')');
		
		// cek periode sudah tersedia atau belum
		$checkPeriode = $this->db->get_where('periode', ['periode' => $periode])->row_array();
		
		if ($checkPeriode) 
		{
			$isi = 'Periode ' . $periode . ' sudah tersedia';
			$this->session->set_flashdata('message-failed', $isi);

			$id_user = $dataUser['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect('periode');
			exit;
		}

		if ($this->input->post('aktif', true)) 
		{
			$aktif = 1;
			// Update all of periode to deactive
			$this->db->update('periode', ['aktif' => '0']);			
		}

		$data = [
			'periode' => $periode,
			'aktif' => $aktif
		];

		$sql_periode = $this->db->insert('periode', $data);
		$id_periode = $this->db->insert_id();

		if ($sql_periode) 
		{
			$data = []; 
			foreach($mahasiswa as $dm) 
			{
				$data[] = [
					'id_mahasiswa' => $dm['id_mahasiswa'],
					'id_periode' => $id_periode
				];
			}

			$this->db->insert_batch('vote', $data);
		}

		$isi = 'Periode ' . $periode . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('periode');
	}

	public function editPeriode($id)
	{
		$dataUser = $this->admo->getDataUserAdmin();


		$periode_old = $this->getPeriodeById($id)['periode'];

		$this->admo->userPrivilegeTamu('periode', ' (mengubah periode ' . $periode_old . ')');

		$periode_new = $this->input->post('dari_tahun', true) . ' - ' . $this->input->post('sampai_tahun', true);
		
		// cek periode sudah tersedia atau belum
		if ($periode_old != $periode_new)
		{
			$checkPeriode = $this->db->get_where('periode', ['periode' => $periode_new])->row_array();
			
			if ($checkPeriode) 
			{
				$isi = 'Periode ' . $periode_new . ' sudah tersedia';
				$this->session->set_flashdata('message-failed', $isi);

				$id_user = $dataUser['id_user'];
				$this->lomo->addLog($isi, $id_user);
				redirect('periode');
				exit;
			}
		}

		if ($this->input->post('aktif', true)) 
		{
			$aktif = 1;
			// Update all of periode to deactive
			$this->db->update('periode', ['aktif' => '0']);			
		}

		$data = [
			'periode' => $periode_new,
			'status' => $this->input->post('status', true),
			'aktif' => $aktif
		];
		
		$status = explode('_', $data['status']);
		$status = implode(' ', $status);
		$status = ucwords(strtolower($status));

		if ($data['aktif'] == 0) 
		{
			$aktif = 'tidak aktif';
		}
		else
		{
			$aktif = 'aktif';
		}

		$this->db->update('periode', $data, ['id_periode' => $id]);
		$isi = 'Periode ' . $periode_old . ' berhasil diubah menjadi ' . $periode_new . ' dengan status ' . $status . ' dan ' . $aktif;
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('periode');
	}

	public function editStatusPeriode($id_periode)
	{
		$dataUser = $this->admo->getDataUserAdmin();
		
		$periode_old = $this->getPeriodeById($id_periode)['periode'];

		$data = [
			'status' => 'sudah_selesai'
		];

		$this->db->update('periode', $data, ['id_periode' => $id_periode]);
		$isi = 'Periode ' . $periode_old . ' berhasil diubah statusnya menjadi Sudah Selesai';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('admin');
	}

	public function removePeriode($id)
	{
		$dataUser = $this->admo->getDataUserAdmin();
		
		$periode = $this->getPeriodeById($id)['periode'];
		$this->admo->userPrivilegeTamu('periode', ' (menghapus periode ' . $periode . ')');
		$this->admo->userPrivilegeAdministrator('periode', ' (menghapus periode ' . $periode . ')');

		$this->db->delete('periode', ['id_periode' => $id]);
		$isi = 'Periode ' . $periode . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('periode');
	}
}
