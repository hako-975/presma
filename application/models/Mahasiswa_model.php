<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Rombel_model', 'romo');
		$this->load->model('Log_model', 'lomo');
		$this->load->model('Admin_model', 'admo');
	}

	public function getMahasiswa()
	{
		$this->db->join('rombel', 'mahasiswa.id_rombel = rombel.id_rombel');
		$this->db->join('jurusan', 'rombel.id_jurusan = jurusan.id_jurusan');
		$this->db->order_by('mahasiswa.nim', 'asc');
		$this->db->order_by('mahasiswa.nama', 'asc');
		return $this->db->get('mahasiswa')->result_array();
	}

	public function getMahasiswaById($id)
	{
		$this->db->join('rombel', 'mahasiswa.id_rombel = rombel.id_rombel');
		$this->db->join('jurusan', 'rombel.id_jurusan = jurusan.id_jurusan');
		return $this->db->get_where('mahasiswa', ['id_mahasiswa' => $id])->row_array();
	}

	public function addMahasiswa()
	{
		$dataUser = $this->admo->getDataUserAdmin();
		
		$nama = ucwords(strtolower($this->input->post('nama', true)));

		$this->admo->userPrivilegeTamu('mahasiswa', ' (menambahkan mahasiswa ' . $nama . ')');

		$data = [
			'nim' => $this->input->post('nim', true),
			'nama' => $nama,
			'tgl_lahir' => $this->input->post('tgl_lahir', true),
			'id_rombel' => $this->input->post('id_rombel', true)
		];

		$rombel_new = $this->romo->getRombelById($data['id_rombel']);
		$rombel_new = $rombel_new['jurusan'] . ', semester ' . $rombel_new['semester'];

		$this->db->insert('mahasiswa', $data);
		$isi = 'Mahasiswa ' . $data['nim'] . ', ' . $data['nama'] . ', ' . $data['tgl_lahir'] . ', ' . $rombel_new . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('mahasiswa');
	}

	public function editMahasiswa($id)
	{
		$dataUser = $this->admo->getDataUserAdmin();

		$mahasiswa = $this->getMahasiswaById($id);
		$nim_old = $mahasiswa['nim'];
		$nama_old = $mahasiswa['nama'];
		$tgl_lahir_old = $mahasiswa['tgl_lahir'];
		$id_rombel_old = $mahasiswa['id_rombel'];
		$rombel_old = $mahasiswa['jurusan'] . ', semester ' . $mahasiswa['semester'];

		$this->admo->userPrivilegeTamu('mahasiswa', ' (mengubah mahasiswa ' . $nama_old . ')');

		$nim_new = $this->input->post('nim', true);
		$nama_new = ucwords(strtolower($this->input->post('nama', true)));

		// cek nim sudah tersedia atau belum
		if ($nim_old != $nim_new)
		{
			$checkNim = $this->db->get_where('mahasiswa', ['nim' => $nim_new])->row_array();
			
			if ($checkNim) 
			{
				$isi = 'nim ' . $nim_new . ' sudah tersedia';
				$this->session->set_flashdata('message-failed', $isi);

				$id_user = $dataUser['id_user'];
				$this->lomo->addLog($isi, $id_user);
				redirect('mahasiswa');
				exit;
			}
		}

		$data = [
			'nim' => $nim_new,
			'nama' => $nama_new,
			'tgl_lahir' => $this->input->post('tgl_lahir', true),
			'id_rombel' => $this->input->post('id_rombel', true)
		];

		$rombel_new = $this->romo->getRombelById($data['id_rombel']);
		$rombel_new = $rombel_new['jurusan'] . ', semester ' . $rombel_new['semester'];
		$tgl_lahir_new = $data['tgl_lahir'];

		$this->db->update('mahasiswa', $data, ['id_mahasiswa' => $id]);
		$isi = 'Mahasiswa ' . $nim_old . ', ' . $nama_old . ', ' . $tgl_lahir_old . ', ' . $rombel_old . ' berhasil diubah menjadi ' . $nim_new . ', ' . $nama_new . ', ' . $tgl_lahir_new . ', ' . $rombel_new;
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('mahasiswa');
	}

	public function removeMahasiswa($id)
	{
		$dataUser = $this->admo->getDataUserAdmin();

		$mahasiswa = $this->getMahasiswaById($id);
		$nama = $mahasiswa['nama'];
		$nim = $mahasiswa['nim'];
		$tgl_lahir = $mahasiswa['tgl_lahir'];
		$rombel = $this->romo->getRombelById($mahasiswa['id_rombel']);
		$rombel = $rombel['jurusan'] . ', semester ' . $rombel['semester'];

		$this->admo->userPrivilegeTamu('mahasiswa', ' (menghapus mahasiswa ' . $nama . ')');

		$this->db->delete('mahasiswa', ['id_mahasiswa' => $id]);
		$isi = 'Mahasiswa ' . $nim . ', ' . $nama . ', ' . $tgl_lahir . ', ' . $rombel . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('mahasiswa');
	}
}
