<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model', 'mamo');
		$this->load->model('Log_model', 'lomo');
		$this->load->model('Admin_model', 'admo');
	}

	public function getVote()
	{
		$this->db->select('*, mahasiswa.nama AS nama_mahasiswa, kandidat.nama AS nama_kandidat');
		$this->db->join('mahasiswa', 'vote.id_mahasiswa = mahasiswa.id_mahasiswa');
		$this->db->join('rombel', 'mahasiswa.id_rombel = rombel.id_rombel');
		$this->db->join('jurusan', 'rombel.id_jurusan = jurusan.id_jurusan');
		$this->db->join('kandidat', 'vote.id_kandidat = kandidat.id_kandidat', 'LEFT');
		$this->db->join('periode', 'vote.id_periode = periode.id_periode');
		$this->db->order_by('tgl_vote', 'asc');
		return $this->db->get('vote')->result_array();
	}

	public function getVoteById($id)
	{
		$this->db->select('*, mahasiswa.nama AS nama_mahasiswa, kandidat.nama AS nama_kandidat');
		$this->db->join('mahasiswa', 'vote.id_mahasiswa = mahasiswa.id_mahasiswa');
		$this->db->join('rombel', 'mahasiswa.id_rombel = rombel.id_rombel');
		$this->db->join('jurusan', 'rombel.id_jurusan = jurusan.id_jurusan');
		$this->db->join('kandidat', 'vote.id_kandidat = kandidat.id_kandidat', 'LEFT');
		$this->db->join('periode', 'vote.id_periode = periode.id_periode');
		return $this->db->get_where('vote', ['id_vote' => $id])->row_array();
	}

	public function getVoteByPeriodeResult($id_periode)
	{
		$this->db->select('*, mahasiswa.nama AS nama_mahasiswa, kandidat.nama AS nama_kandidat, periode.status AS status_periode');
		$this->db->join('mahasiswa', 'vote.id_mahasiswa = mahasiswa.id_mahasiswa');
		$this->db->join('rombel', 'mahasiswa.id_rombel = rombel.id_rombel');
		$this->db->join('jurusan', 'rombel.id_jurusan = jurusan.id_jurusan');
		$this->db->join('kandidat', 'vote.id_kandidat = kandidat.id_kandidat', 'LEFT');
		$this->db->join('periode', 'vote.id_periode = periode.id_periode');
		$this->db->order_by('rombel.semester', 'asc');
		$this->db->order_by('jurusan.jurusan', 'asc');
		$this->db->order_by('mahasiswa.nama', 'asc');
		return $this->db->get_where('vote', ['vote.id_periode' => $id_periode])->result_array();
	}

	public function addVote($url_periode = null)
	{
		$dataUser = $this->admo->getDataUserAdmin();

		$id_mahasiswa = $this->input->post('id_mahasiswa', true);
		$id_periode = $this->input->post('id_periode', true);

		$mahasiswa = $this->mamo->getMahasiswaById($id_mahasiswa);
		$nama_new = $mahasiswa['nama'];
		$nim_new = $mahasiswa['nim'];

		$periode = $this->pemo->getPeriodeById($id_periode);
		$periode_new = $periode['periode'];

		$this->admo->userPrivilegeTamu('vote/periode/' . $url_periode, ' (menambahkan vote ' . $nama_new . ', ' . $periode_new . ')');

		// check mahasiswa and periode
		$check = $this->db->get_where('vote', ['id_mahasiswa' => $id_mahasiswa, 'id_periode' => $id_periode])->row_array();
		if ($check) 
		{
			$isi = 'Data vote ' . $nim_new . ', ' . $nama_new . ', ' . $periode_new . ' gagal ditambahkan, sudah tersedia';
			$this->session->set_flashdata('message-failed', $isi);

			if ($url_periode == null) 
			{
				redirect('vote');
			}
			else
			{
				redirect('vote/periode/' . $url_periode);
			}
		}

		$data = [
			'id_mahasiswa' => $id_mahasiswa,
			'id_periode' => $id_periode
		];

		$this->db->insert('vote', $data);
		$isi = 'Data vote ' . $nim_new . ', ' . $nama_new . ', ' . $periode_new . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		if ($url_periode == null) 
		{
			redirect('vote');
		}
		else
		{
			redirect('vote/periode/' . $url_periode);
		}
	}

	// public function editVote($id, $url_periode = null)
	// {
	// 	$dataUser = $this->admo->getDataUserAdmin();

	// 	$vote = $this->getVoteById($id);

	// 	$data = [
	// 		'vote' => $this->input->post('vote', true),
	// 		'tgl_vote' => time(),
	// 		'id_mahasiswa' => $this->input->post('id_mahasiswa', true),
	// 		'id_kandidat' => $this->input->post('id_kandidat', true),
	// 		'id_periode' => $this->input->post('id_periode', true)
	// 	];

	// 	$mahasiswa = $this->mamo->getMahasiswaById($data['id_mahasiswa']);
	// 	$nama_new = $mahasiswa['nama'];
	// 	$nim_new = $mahasiswa['nim'];

	// 	$periode = $this->pemo->getPeriodeById($data['id_periode']);
	// 	$periode_new = $periode['periode'];

	// 	$this->db->update('vote', $data, ['id_vote' => $id]);
	// 	$isi = 'Data vote ' . $nim_new . ', ' . $nama_new . ', ' . $periode_new . ' berhasil diubah';
	// 	$this->session->set_flashdata('message-success', $isi);
		
	// 	$id_user = $dataUser['id_user'];
	// 	$this->lomo->addLog($isi, $id_user);
		
	// 	if ($url_periode == null) 
	// 	{
	// 		redirect('vote');
	// 	}
	// 	else
	// 	{
	// 		redirect('vote/periode/' . $url_periode);
	// 	}
	// }

	public function removeVote($id, $url_periode = null)
	{
		$dataUser = $this->admo->getDataUserAdmin();

		$vote = $this->getVoteById($id);
		$id_mahasiswa = $vote['id_mahasiswa'];
		$id_periode = $vote['id_periode'];

		$mahasiswa = $this->mamo->getMahasiswaById($id_mahasiswa);
		$nama_old = $mahasiswa['nama'];
		$nim_old = $mahasiswa['nim'];

		$periode = $this->pemo->getPeriodeById($id_periode);
		$periode_old = $periode['periode'];

		$this->admo->userPrivilegeTamu('vote/periode/' . $url_periode, ' (menghapus vote ' . $nama_old . ', ' . $periode_old . ')');

		$this->db->delete('vote', ['id_vote' => $id]);
		$isi = 'Data vote ' . $nim_old . ', ' . $nama_old . ', ' . $periode_old . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		
		if ($url_periode == null) 
		{
			redirect('vote');
		}
		else
		{
			redirect('vote/periode/' . $url_periode);
		}
	}
}
