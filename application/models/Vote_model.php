<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Log_model', 'lomo');
		$this->load->model('Admin_model', 'admo');
	}

	public function getVote()
	{
		$this->db->select('*, mahasiswa.nama AS nama_mahasiswa, kandidat.nama AS nama_kandidat');
		$this->db->join('mahasiswa', 'vote.id_mahasiswa = mahasiswa.id_mahasiswa');
		$this->db->join('kandidat', 'vote.id_kandidat = kandidat.id_kandidat');
		$this->db->join('periode', 'vote.id_periode = periode.id_periode');
		$this->db->order_by('tgl_vote', 'asc');
		return $this->db->get('vote')->result_array();
	}

	public function getVoteById($id)
	{
		$this->db->select('*, mahasiswa.nama AS nama_mahasiswa, kandidat.nama AS nama_kandidat');
		$this->db->join('mahasiswa', 'vote.id_mahasiswa = mahasiswa.id_mahasiswa');
		$this->db->join('kandidat', 'vote.id_kandidat = kandidat.id_kandidat');
		$this->db->join('periode', 'vote.id_periode = periode.id_periode');
		return $this->db->get_where('vote', ['id_vote' => $id])->row_array();
	}

	public function addVote()
	{
		$data = [
			'id_mahasiswa' => $this->input->post('id_mahasiswa', true),
			'id_periode' => $this->input->post('id_periode', true)
		];

		$this->db->insert('vote', $data);
		$isi = 'Vote ' . $data['vote'] . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('vote');
	}

	public function editVote($id)
	{
		$vote = $this->getVoteById($id);

		$data = [
			'vote' => $this->input->post('vote', true),
			'tgl_vote' => time(),
			'id_mahasiswa' => $this->input->post('id_mahasiswa', true),
			'id_kandidat' => $this->input->post('id_kandidat', true),
			'id_periode' => $this->input->post('id_periode', true)
		];

		$this->db->update('vote', $data, ['id_vote' => $id]);
		// $isi = 'Vote ' . $vote . ' berhasil diubah menjadi ' . $data['vote'];
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('vote');
	}

	public function removeVote($id)
	{
		$vote = $this->getVoteById($id);
		$this->db->delete('vote', ['id_vote' => $id]);
		// $isi = 'Vote ' . $vote . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('vote');
	}
}
