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
		$this->db->join('periode', 'kandidat.id_periode = periode.id_periode');
		$this->db->order_by('no_urut', 'asc');
		return $this->db->get('kandidat')->result_array();
	}

	public function getKandidatById($id)
	{
		$this->db->join('periode', 'kandidat.id_periode = periode.id_periode');
		return $this->db->get_where('kandidat', ['id_kandidat' => $id])->row_array();
	}

	public function getKandidatByIdPeriode($id_periode)
	{
		$this->db->order_by('no_urut', 'asc');
		$this->db->join('periode', 'kandidat.id_periode = periode.id_periode');
		return $this->db->get_where('kandidat', ['periode.id_periode' => $id_periode])->result_array();
	}

	public function getKandidatByPeriodeResult($id_periode)
	{
		$this->db->order_by('no_urut', 'asc');
		$this->db->join('periode', 'kandidat.id_periode = periode.id_periode');
		return $this->db->get_where('kandidat', ['periode.id_periode' => $id_periode])->result_array();
	}
	

	public function addKandidat($url_periode = null)
	{
		$dataUser = $this->admo->getDataUserAdmin();
		
		$nama = ucwords(strtolower($this->input->post('nama', true)));

		$this->admo->userPrivilegeTamu('kandidat/periode/' . $url_periode, ' (menambahkan kandidat ' . $nama . ')');

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
		else
		{
			$this->db->set('foto_kandidat', 'default.png');
		}

		$data = [
			'nim' => $this->input->post('nim', true),
			'nama' => $nama,
			'visi' => $this->input->post('visi', true),
			'misi' => $this->input->post('misi', true),
			'no_urut' => $this->input->post('no_urut', true),
			'id_periode' => $this->input->post('id_periode', true)
		];

		$this->db->insert('kandidat', $data);
		$isi = 'Kandidat ' . $data['nama'] . ' dengan NIM ' . $data['nim'] . ' berhasil ditambahkan';
		$this->session->set_flashdata('message-success', $isi);

		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		if ($url_periode == null) 
		{
			redirect('kandidat');
		}
		else
		{
			redirect('kandidat/periode/' . $url_periode);
		}
	}

	public function editKandidat($id_kandidat, $url_periode = null)
	{
		$dataUser = $this->admo->getDataUserAdmin();
		
		$kandidat = $this->getKandidatById($id_kandidat);
		$nim_old = $kandidat['nim'];
		$nama_old = $kandidat['nama'];
		$no_urut_old = $kandidat['no_urut'];
		
		$this->admo->userPrivilegeTamu('kandidat', ' (mengubah kandidat ' . $nama_old . ')');

		$nim_new = $this->input->post('nim', true);
		$no_urut_new = $this->input->post('no_urut', true);

		// cek nim sudah tersedia atau belum
		if ($nim_old != $nim_new)
		{
			$checkNim = $this->db->get_where('kandidat', ['nim' => $nim_new])->row_array();
			
			if ($checkNim) 
			{
				$isi = 'nim ' . $nim_new . ' sudah tersedia';
				$this->session->set_flashdata('message-failed', $isi);

				$id_user = $dataUser['id_user'];
				$this->lomo->addLog($isi, $id_user);
				if ($url_periode == null) 
				{
					redirect('kandidat');
				}
				else
				{
					redirect('kandidat/periode/' . $url_periode);
				}
				exit;
			}
		}

		// cek no urut sudah tersedia atau belum
		if ($no_urut_old != $no_urut_new)
		{
			$checkNoUrut = $this->db->get_where('kandidat', ['no_urut' => $no_urut_new])->row_array();
			
			if ($checkNoUrut) 
			{
				$isi = 'No. Urut ' . $no_urut_new . ' sudah tersedia';
				$this->session->set_flashdata('message-failed', $isi);

				$id_user = $dataUser['id_user'];
				$this->lomo->addLog($isi, $id_user);
				if ($url_periode == null) 
				{
					redirect('kandidat');
				}
				else
				{
					redirect('kandidat/periode/' . $url_periode);
				}
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
			'no_urut' => $no_urut_new,
			'id_periode' => $this->input->post('id_periode', true)
		];

		$this->db->update('kandidat', $data, ['id_kandidat' => $id_kandidat]);
		$isi = 'Kandidat ' . $nim_old . ', Nama: ' . $nama_old . ', No. Urut: ' . $no_urut . ' berhasil diubah menjadi ' . $nim_new . ', Nama: ' . $data['nama'] . ', No. Urut: ' . $no_urut_new;
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		if ($url_periode == null) 
		{
			redirect('kandidat');
		}
		else
		{
			redirect('kandidat/periode/' . $url_periode);
		}
	}

	public function removeKandidat($id_kandidat, $url_periode = null)
	{
		$dataUser = $this->admo->getDataUserAdmin();
		
		$kandidat = $this->getKandidatById($id_kandidat);
		$nama_old = $kandidat['nama'];
		$nim_old = $kandidat['nim'];
		$this->admo->userPrivilegeTamu('kandidat', ' (menghapus kandidat ' . $nama_old . ')');

		$this->db->delete('kandidat', ['id_kandidat' => $id_kandidat]);
		$isi = 'Kandidat ' . $nim_old . ', ' . $nama_old . ' berhasil dihapus';
		$this->session->set_flashdata('message-success', $isi);
		
		$id_user = $dataUser['id_user'];
		$this->lomo->addLog($isi, $id_user);
		if ($url_periode == null) 
		{
			redirect('kandidat');
		}
		else
		{
			redirect('kandidat/periode/' . $url_periode);
		}
	}
}
