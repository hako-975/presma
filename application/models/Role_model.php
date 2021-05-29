<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Log_model', 'lomo');
		$this->load->model('Admin_model', 'admo');
	}

	public function getRole()
	{
		$this->db->order_by('role', 'asc');
		return $this->db->get('role')->result_array();
	}

	public function getRoleById($id)
	{
		return $this->db->get_where('role', ['id_role' => $id])->row_array();
	}

	public function addRole()
	{
		$dataUser = $this->admo->getDataUserAdmin();
		$role = ucwords(strtolower($this->input->post('role', true)));

		$this->admo->userPrivilege('role', ' (menambahkan Jabatan ' . $role . ')');

		$data = [
			'role' => $role
		];

		$this->db->insert('role', $data);
		$isi = 'Jabatan ' . $role . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('role');
	}

	public function editRole($id)
	{
		$dataUser = $this->admo->getDataUserAdmin();
		
		$role = $this->getRoleById($id)['role'];
		
		$this->admo->userPrivilege('role', ' (mengubah Jabatan ' . $role . ')');

		if ($role == 'Administrator')
		{
			$isi = 'Akses ditolak! Jabatan ' . $role . ' tidak boleh diubah';
			$this->session->set_flashdata('message-failed', $isi);
			
			$id_user = $dataUser['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect('role');
			exit();
		}

		$data = [
			'role' => ucwords(strtolower($this->input->post('role', true)))
		];

		$this->db->update('role', $data, ['id_role' => $id]);
		$isi = 'Jabatan ' . $role . ' berhasil diubah menjadi ' . $data['role'];
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('role');
	}

	public function removeRole($id)
	{
		$dataUser = $this->admo->getDataUserAdmin();

		$role = $this->getRoleById($id)['role'];

		$this->admo->userPrivilege('role', ' (menghapus Jabatan ' . $role . ')');
		
		if ($role == 'Administrator')
		{
			$isi = 'Akses ditolak! Jabatan ' . $role . ' tidak boleh dihapus';
			$this->session->set_flashdata('message-failed', $isi);
			
			$id_user = $dataUser['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect('role');
			exit();
		}

		$this->db->delete('role', ['id_role' => $id]);
		$isi = 'Jabatan ' . $role . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('role');
	}
}
