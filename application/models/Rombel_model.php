<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rombel_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jurusan_model', 'jumo');
		$this->load->model('Log_model', 'lomo');
		$this->load->model('Admin_model', 'admo');
	}

	public function getRombel()
	{
		$this->db->join('jurusan', 'rombel.id_jurusan = jurusan.id_jurusan');
		$this->db->order_by('rombel.semester', 'asc');
		$this->db->order_by('jurusan.jurusan', 'asc');
		return $this->db->get('rombel')->result_array();
	}

	public function getRombelById($id)
	{
		$this->db->join('jurusan', 'rombel.id_jurusan = jurusan.id_jurusan');
		return $this->db->get_where('rombel', ['id_rombel' => $id])->row_array();
	}

	public function addRombel()
	{
		$dataUser = $this->admo->getDataUserAdmin();

		$data = [
			'semester' => $this->input->post('semester', true),
			'id_jurusan' => $this->input->post('id_jurusan', true)
		];
		
		$jurusan = $this->jumo->getJurusanById($data['id_jurusan'])['jurusan'];

		$this->admo->userPrivilegeTamu('rombel', ' (menambahkan Rombel ' . $jurusan . ' semester ' . $data['semester'] . ')');

		// Cek rombel sudah tersedia atau belum
		$checkRombel = $this->db->get_where('rombel', ['semester' => $data['semester'], 'id_jurusan' => $data['id_jurusan']])->row_array();
		
		if ($checkRombel) 
		{
			$isi = 'Rombel '. $jurusan . ' semester ' . $data['semester'] . ' sudah tersedia';
			$this->session->set_flashdata('message-failed', $isi);

			$id_user = $dataUser['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect('rombel');
			exit;
		}

		$this->db->insert('rombel', $data);
		$isi = 'Rombel '. $jurusan . ' semester ' . $data['semester'] . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('rombel');
	}

	public function editRombel($id)
	{
		$dataUser = $this->admo->getDataUserAdmin();

		$rombel_old = $this->getRombelById($id);
		$jurusan_old = $rombel_old['jurusan'];
		$semester_old = $rombel_old['semester'];

		$this->admo->userPrivilegeTamu('rombel', ' (mengubah Rombel ' . $jurusan_old . ' semester ' . $semester_old . ')');

		$data = [
			'semester' => $this->input->post('semester', true),
			'id_jurusan' => $this->input->post('id_jurusan', true)
		];

		$jurusan_new = $this->jumo->getJurusanById($data['id_jurusan'])['jurusan'];
		// Cek rombel sudah ada atau belum
		$checkRombel = $this->db->get_where('rombel', ['semester' => $data['semester'], 'id_jurusan' => $data['id_jurusan']])->row_array();
		
		if ($checkRombel) 
		{
			$isi = 'Rombel '. $jurusan_new . ' semester ' . $data['semester'] . ' sudah tersedia';
			$this->session->set_flashdata('message-failed', $isi);

			$id_user = $dataUser['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect('rombel');
			exit;
		}

		$this->db->update('rombel', $data, ['id_rombel' => $id]);
		$isi = 'Rombel ' . $jurusan_old . ' semester ' . $semester_old . ' berhasil diubah menjadi ' . $jurusan_new . ' semester ' . $data['semester'];
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('rombel');
	}

	public function removeRombel($id)
	{
		$dataUser = $this->admo->getDataUserAdmin();
		$rombel_old = $this->getRombelById($id);
		$jurusan_old = $rombel_old['jurusan'];
		$semester_old = $rombel_old['semester'];

		$this->admo->userPrivilegeTamu('rombel', ' (menghapus rombel ' . $jurusan_old . ' semester ' . $semester_old . ')');
		$this->admo->userPrivilegeAdministrator('rombel', ' (menghapus rombel ' . $jurusan_old . ' semester ' . $semester_old . ')');
		

		$this->db->delete('rombel', ['id_rombel' => $id]);
		$isi = 'Rombel '. $jurusan_old . ' semester ' . $semester_old . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('rombel');
	}
}
