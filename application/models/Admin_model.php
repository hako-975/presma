<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model 
{
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

	public function userPrivilege($redirect = 'admin', $isi2 = '')
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
}