<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model', 'mamo');
		$this->load->model('Kandidat_model', 'kamo');
		$this->load->model('Periode_model', 'pemo');
	}

	public function loginVote()
	{
		$nim 		= $this->input->post('nim', true);
		$password 	= $this->input->post('password', true);
		
		// check nim
		$data = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
		if ($data) 
		{
			$currentPassword = date('dmy', strtotime($data['tgl_lahir']));

			if ($password == $currentPassword) 
			{
				// check status vote
				$dataVote = $this->db->get_where('vote', ['id_mahasiswa' => $data['id_mahasiswa']])->row_array();

				if ($dataVote['vote'] == 'belum') 
				{
					$dataSession = [
						'id_mahasiswa' => $data['id_mahasiswa']
					];

					$this->session->set_userdata($dataSession);
					redirect('landing/vote');
				}
				elseif ($dataVote['vote'] == 'sudah')
				{
					$isi = 'Anda telah melakukan voting';
					$this->session->set_flashdata('message-failed', $isi);
					redirect('landing/loginVote');
				}
				else
				{
					$isi = 'NIM Anda belum terdaftar, segera hubungi Administrator';
					$this->session->set_flashdata('message-failed', $isi);
					redirect('landing/loginVote');
				}
			}
			else
			{
				$isi = 'Password yang anda masukkan salah';
				$this->session->set_flashdata('message-failed', $isi);
				redirect('landing/loginVote');
			}	
			
		}
		else
		{
			$isi = 'NIM yang anda masukkan salah atau belum terdaftar';
			$this->session->set_flashdata('message-failed', $isi);
			redirect('landing/loginVote');
		}
	}

	public function voteKandidat($id_kandidat, $id_mahasiswa, $id_periode)
	{
		if (!isset($_SESSION['id_mahasiswa'])) {
			redirect('landing/loginVote');
			exit;	
		}

		if ($id_mahasiswa != $_SESSION['id_mahasiswa']) 
		{
			redirect('landing/loginVote');
			exit;
		}

		$data = [
			'tgl_vote' => time(),
			'id_kandidat' => $id_kandidat,
			'vote' => 'sudah'
		];

		$this->db->update('vote', $data, ['id_mahasiswa' => $id_mahasiswa, 'id_periode' => $id_periode]);
		
		$mahasiswa = $this->mamo->getMahasiswaById($id_mahasiswa);
		$kandidat = $this->kamo->getKandidatById($id_kandidat);
		$periode = $this->pemo->getPeriodeById($id_periode);
		$isi = 'Anda ' . $mahasiswa['nama'] . ' telah berhasil melakukan vote kandidat ' . $kandidat['nama'] . ' periode ' . $periode['periode'];
		session_destroy();		
		redirect('landing/afterVote/' . $isi);
	}
}