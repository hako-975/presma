<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Log_model', 'lomo');
		$this->load->model('Admin_model', 'admo');
	}

	public function getJurusan()
	{
		$this->db->order_by('jurusan', 'asc');
		return $this->db->get('jurusan')->result_array();
	}

	public function getJurusanById($id)
	{
		return $this->db->get_where('jurusan', ['id_jurusan' => $id])->row_array();
	}

	public function addJurusan()
	{
		$data = [
			'jurusan' => ucwords(strtolower($this->input->post('jurusan', true)))
		];

		$this->db->insert('jurusan', $data);
		$isi = 'Jurusan ' . $data['jurusan'] . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('jurusan');
	}

	public function editJurusan($id)
	{
		$jurusan = $this->getJurusanById($id)['jurusan'];

		$data = [
			'jurusan' => ucwords(strtolower($this->input->post('jurusan', true)))
		];

		$this->db->update('jurusan', $data, ['id_jurusan' => $id]);
		$isi = 'Jurusan ' . $jurusan . ' berhasil diubah menjadi ' . $data['jurusan'];
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('jurusan');
	}

	public function removeJurusan($id)
	{
		$jurusan = $this->getJurusanById($id)['jurusan'];
		$this->db->delete('jurusan', ['id_jurusan' => $id]);
		$isi = 'Jurusan ' . $jurusan . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('jurusan');
	}
}