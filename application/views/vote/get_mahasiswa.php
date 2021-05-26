<?php 
$data = $_POST['data'];
$id = $_POST['id'];
 
?>
<?php if($data == "mahasiswa") : ?>
	<select id="id_mahasiswa" name="id_mahasiswa">
		<option value="0">Pilih Mahasiswa</option>
		<?php 
			$mahasiswa = $this->db->get_where('mahasiswa', ['id_rombel' => $id])->result_array();
		?>
		<?php foreach ($mahasiswa as $datamahasiswa): ?>
			<option value="<?= $datamahasiswa['id_mahasiswa']; ?>"><?= $datamahasiswa['nama']; ?></option>
		<?php endforeach ?>
	</select>
 
<?php endif ?>