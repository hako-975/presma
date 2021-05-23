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
		return $this->db->get('Role')->result_array();
	}

	public function getRoleById($id)
	{
		return $this->db->get_where('role', ['id_role' => $id])->row_array();
	}

	public function addRole()
	{
		$data = [
			'role' => ucwords(strtolower($this->input->post('role', true)))
		];

		$this->db->insert('role', $data);
		$isi = 'Role ' . $data['role'] . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('role');
	}

	public function editRole($id)
	{
		$role = $this->getRoleById($id)['role'];
		
		if ($role == 'Administrator')
		{
			$isi = 'Akses ditolak! Role ' . $role . ' tidak boleh diubah';
			$this->session->set_flashdata('message-failed', $isi);
			
			$id_user = $this->admo->getDataUserAdmin()['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect('role');
		}

		$data = [
			'role' => ucwords(strtolower($this->input->post('role', true)))
		];

		$this->db->update('role', $data, ['id_role' => $id]);
		$isi = 'Role ' . $role . ' berhasil diubah menjadi ' . $data['role'];
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('role');
	}

	public function removeRole($id)
	{
		$role = $this->getRoleById($id)['role'];
		
		if ($role == 'Administrator')
		{
			$isi = 'Akses ditolak! Role ' . $role . ' tidak boleh dihapus';
			$this->session->set_flashdata('message-failed', $isi);
			
			$id_user = $this->admo->getDataUserAdmin()['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect('role');
		}

		$this->db->delete('role', ['id_role' => $id]);
		$isi = 'Role ' . $role . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('role');
	}
}
