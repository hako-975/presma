<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kandidat_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Log_model', 'lomo');
		$this->load->model('Admin_model', 'admo');
	}

	public function getKandidat()
	{
		$this->db->order_by('no_urut', 'asc');
		return $this->db->get('kandidat')->result_array();
	}

	public function getKandidatById($id)
	{
		return $this->db->get_where('kandidat', ['id_kandidat' => $id])->row_array();
	}

	public function addKandidat()
	{
		$foto_kandidat = $_FILES['foto_kandidat']['name'];
		if ($foto_kandidat) 
		{
			$config['upload_path'] = './assets/img/img_candidates/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
		
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('foto_kandidat'))
			{
				$new_foto_kandidat = $this->upload->data('file_name');
				$this->db->set('foto_kandidat', $new_foto_kandidat);
			} 
			else 
			{
				echo $this->upload->display_errors();
			}
		}

		$data = [
			'nim' => $this->input->post('nim', true),
			'nama' => ucwords(strtolower($this->input->post('nama', true))),
			'visi' => $this->input->post('visi', true),
			'misi' => $this->input->post('misi', true),
			'no_urut' => $this->input->post('no_urut', true)
		];

		$this->db->insert('kandidat', $data);
		$isi = 'Kandidat ' . $data['nama'] . ' dengan NIM ' . $data['nim'] . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('kandidat');
	}

	public function editKandidat($id)
	{
		$kandidat = $this->getKandidatById($id);
		$nim_old = $kandidat['nim'];
		$nama_old = $kandidat['nama'];
		$no_urut_old = $kandidat['no_urut'];

		$nim_new = $this->input->post('nim', true);

		// cek nim sudah tersedia atau belum
		if ($nim_old != $nim_new)
		{
			$checkNim = $this->db->get_where('kandidat', ['nim' => $nim_new])->row_array();
			
			if ($checkNim) 
			{
				$isi = 'nim ' . $nim_new . ' sudah tersedia';
				$this->session->set_flashdata('message-failed', $isi);

				$id_user = $this->admo->getDataUserAdmin()['id_user'];
				$this->lomo->addLog($isi, $id_user);
				redirect('kandidat');
				exit;
			}
		}

		$foto_kandidat = $_FILES['foto_kandidat']['name'];
		if ($foto_kandidat) 
		{
			$config['upload_path'] = './assets/img/img_candidates/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
		
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('foto_kandidat')) 
			{
				$old_foto_kandidat = $kandidat['foto_kandidat'];
				if ($old_foto_kandidat != 'default.png') 
				{
					unlink(FCPATH . 'assets/img/img_candidates/' . $kandidat['foto_kandidat']);
				}
				$new_foto_kandidat = $this->upload->data('file_name');
				$this->db->set('foto_kandidat', $new_foto_kandidat);
			}
			else 
			{
				echo $this->upload->display_errors();
			}
		}

		$data = [
			'nim' => $nim_new,
			'nama' => ucwords(strtolower($this->input->post('nama', true))),
			'visi' => $this->input->post('visi', true),
			'misi' => $this->input->post('misi', true),
			'no_urut' => $this->input->post('no_urut', true)
		];

		$this->db->update('kandidat', $data, ['id_kandidat' => $id]);
		$isi = 'Kandidat ' . $nim_old . ', Nama: ' . $nama_old . ', No. Urut: ' . $no_urut . ' berhasil diubah menjadi ' . $nim_new . ', Nama: ' . $data['nama'] . ', No. Urut: ' . $data['no_urut'];
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('kandidat');
	}

	public function removeKandidat($id)
	{
		$kandidat = $this->getKandidatById($id);
		$nama_old = $kandidat['nama'];
		$nim_old = $kandidat['nim'];
		
		$this->db->delete('kandidat', ['id_kandidat' => $id]);
		$isi = 'Kandidat ' . $nim_old . ', ' . $nama_old . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $this->admo->getDataUserAdmin()['id_user'];
		$this->lomo->addLog($isi, $id_user);
		redirect('kandidat');
	}
}
