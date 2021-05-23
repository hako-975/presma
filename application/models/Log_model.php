<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model 
{
	public function getLog()
	{
		$this->db->join('user', 'log.id_user = user.id_user');
		$this->db->order_by('tgl_log', 'desc');
		return $this->db->get('Log')->result_array();
	}

	public function addLog($isi_log, $id_user = 1)
	{
		$data = [
			'isi_log' => $isi_log,
			'tgl_log' => time(),
			'id_user' => $id_user
		];

		return $this->db->insert('log', $data);
	}
}