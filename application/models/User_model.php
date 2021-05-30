<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Log_model', 'lomo');
		$this->load->model('Admin_model', 'admo');
		$this->load->model('Role_model', 'romo');
	}

	public function getUser()
	{
		$this->db->join('role', 'user.id_role = role.id_role');
		$this->db->order_by('role.role', 'asc');
		return $this->db->get('user')->result_array();
	}

	public function getUserById($id)
	{
		$this->db->join('role', 'user.id_role = role.id_role');
		return $this->db->get_where('user', ['user.id_user' => $id])->row_array();
	}

	public function addUser()
	{
		$dataUser = $this->admo->getDataUserAdmin();

		$username = $this->input->post('username', true);

		$this->admo->userPrivilegeTamu('user', ' (menambahkan user ' . $username . ')');
		$this->admo->userPrivilegeAdministrator('user', ' (menambahkan user ' . $username . ')');
		
		$data = [
			'username' => $username,
			'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
			'id_role' => $this->input->post('id_role', true)
		];

		$role = $this->romo->getRoleById($data['id_role'])['role'];
		
		$this->db->insert('user', $data);
		$isi = 'User ' . $data['username'] . ' dengan jabatan ' . $role . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('user');
	}

	public function editUser($id)
	{
		$dataUser = $this->admo->getDataUserAdmin();
		
		$user = $this->getUserById($id);
		$username = $user['username'];
		$role = $user['role'];

		$this->admo->userPrivilegeTamu('user', ' (mengubah user ' . $username . ')');
		$this->admo->userPrivilegeAdministrator('user', ' (mengubah user ' . $username . ')');

		if ($role == 'Administrator')
		{
			$isi = 'Akses ditolak! Role ' . $role . ' tidak boleh diubah';
			$this->session->set_flashdata('message-failed', $isi);
			
			$id_user = $dataUser['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect('user');
			exit();
		}

		$data = [
			'username' => $this->input->post('username', true),
			// 'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
			'id_role' => $this->input->post('id_role', true)
		];

		$new_role = $this->romo->getRoleById($data['id_role'])['role'];

		$this->db->update('user', $data, ['id_user' => $id]);
		$isi = 'User ' . $username . ' berhasil diubah menjadi ' . $data['username'] . ' dan jabatan ' . $role . ' menjadi ' . $new_role;
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('user');
	}

	public function removeUser($id)
	{
		$dataUser = $this->admo->getDataUserAdmin();
		
		$user = $this->getUserById($id);
		$username_old = $user['username'];
		$role = $user['role'];

		$this->admo->userPrivilegeTamu('user', ' (menghapus user ' . $username_old . ')');
		$this->admo->userPrivilegeAdministrator('user', ' (menghapus user ' . $username_old . ')');
		
		if ($role == 'Administrator')
		{
			$isi = 'Akses ditolak! Role ' . $role . ' tidak boleh dihapus';
			$this->session->set_flashdata('message-failed', $isi);
			
			$id_user = $dataUser['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect('user');
			exit();
		}

		$this->db->delete('user', ['id_user' => $id]);
		$isi = 'User ' . $username_old . ' dengan jabatan ' . $role . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('user');
	}
}
