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
}