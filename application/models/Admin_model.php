<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Log_model', 'lomo');
	}
	
	public function checkLoginAdmin()
	{
		if (!$this->session->userdata('id_user')) 
		{
			redirect('auth');
		}
	}

	public function getDataUserByUsername($username)
	{
		$this->db->join('role', 'user.id_role = role.id_role');
		return $this->db->get_where('user', ['username' => $username])->row_array();
	}

	public function getDataUserById($id)
	{
		$this->db->join('role', 'user.id_role = role.id_role');
		return $this->db->get_where('user', ['id_user' => $id])->row_array();
	}

	public function getDataUserAdmin()
	{
		$id_user = $this->session->userdata('id_user'); 
		$this->db->join('role', 'user.id_role = role.id_role');
		return $this->db->get_where('user', ['id_user' => $id_user])->row_array();
	}

	public function userPrivilegeAdministrator($redirect = 'admin', $isi2 = '')
	{
		$dataUser = $this->getDataUserAdmin();

		if ($dataUser['role'] != 'Administrator') 
		{
			$isi = 'Akses ditolak! Karena jabatan anda sebagai ' . $dataUser['role'] . '! Hubungi Administrator untuk melakukan perubahan! ';
			$isi .= ucfirst($isi2);

			$this->session->set_flashdata('message-failed', $isi);
			
			$id_user = $dataUser['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect($redirect);
			exit();
		}
	}

	public function userPrivilegeTamu($redirect = 'admin', $isi2 = '')
	{
		$dataUser = $this->getDataUserAdmin();

		if ($dataUser['role'] == 'Tamu') 
		{
			$isi = 'Akses ditolak! Karena jabatan anda sebagai ' . $dataUser['role'] . '! Hubungi Administrator untuk melakukan perubahan! ';
			$isi .= ucfirst($isi2);

			$this->session->set_flashdata('message-failed', $isi);
			
			$id_user = $dataUser['id_user'];
			$this->lomo->addLog($isi, $id_user);
			redirect($redirect);
			exit();
		}
	}

	public function changePassword()
	{
		$dataUser = $this->getDataUserAdmin();
		$id_user = $dataUser['id_user'];
		
		// check old password
		$old_password = $this->input->post('old_password', true);
		
		if (password_verify($old_password, $dataUser['password']))
		{
			$new_password = password_hash($this->input->post('new_password', true), PASSWORD_DEFAULT);
			
			$data = [
				'password' => $new_password
			];

			$this->db->update('user', $data, ['id_user' => $id_user]);
			
			$isi = 'Berhasil mengubah password';
			$this->session->set_flashdata('message-success', $isi);
			$this->lomo->addLog($isi, $id_user);
			redirect('admin/profile');
		}
		else
		{
			$isi = 'Gagal mengubah password, password lama yang anda masukkan salah';
			$this->session->set_flashdata('message-failed', $isi);
			
			$this->lomo->addLog($isi, $id_user);
			redirect('admin/profile');
		}
	}
}
