<div class="container pt-2">
	<div class="row my-3">
		<div class="col-lg">
			<h3 class="text-center text-white">Pemilihan Presiden Mahasiswa Periode <?= $vote[0]['periode']; ?></h3>
			<hr style="width: 75%; background-color: white;">
		</div>
	</div>
	<div class="row justify-content-center my-3">
		<?php foreach ($kandidat as $dk): ?>
			<div class="col-lg">
				<div class="card m-3 mx-auto" style="width: 300px">
					<img src="<?= base_url('assets/img/img_candidates/') . $dk['foto_kandidat']; ?>" class="card-img-top img-300" alt="Foto Kandidat">
					<div class="card-body text-center">
						<h2><?= $dk['no_urut']; ?></h2>
						<h5><?= $dk['nama']; ?></h5>
						<div class="row my-3">
							<div class="col">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visiMisiModal<?= $dk['id_kandidat']; ?>"><i class="fas fa-fw fa-bullseye"></i> Visi & Misi</button>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade" id="visiMisiModal<?= $dk['id_kandidat']; ?>" tabindex="-1" aria-labelledby="visiMisiModalLabel<?= $dk['id_kandidat']; ?>" aria-hidden="true">
						  <div class="modal-dialog modal-lg modal-dialog-scrollable">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="visiMisiModalLabel<?= $dk['id_kandidat']; ?>">Kandidat No. <?= $dk['no_urut']; ?> | <?= $dk['nama']; ?></h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body p-5">
								<img src="<?= base_url('assets/img/img_candidates/') . $dk['foto_kandidat']; ?>" class="card-img-top img-300 mb-3" alt="Foto Kandidat">
								<h3><?= $dk['nama']; ?></h3>
								<hr style="width: 50%">
								<h4 class="text-left">Visi</h5>
								<p class="text-left"><?= $dk['visi']; ?></p>
								<h4 class="text-left">Misi</h5>
								<p class="text-left"><?= $dk['misi']; ?></p>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
						        <a href="<?= base_url('landing/voteKandidat/') . $dk['id_kandidat'] . '/' . $_SESSION['id_mahasiswa'] . '/' . $dk['id_periode']; ?>" class="btn btn-danger btn-vote" data-nama="No. <?= $dk['no_urut']; ?> | <?= $dk['nama']; ?>"><i class="fas fa-fw fa-vote-yea"></i> Vote</a>
						      </div>
						    </div>
						  </div>
						</div>

						<div class="row my-3">
							<div class="col">
								<a href="<?= base_url('landing/voteKandidat/') . $dk['id_kandidat'] . '/' . $_SESSION['id_mahasiswa'] . '/' . $dk['id_periode']; ?>" class="btn btn-danger btn-vote" data-nama="No. <?= $dk['no_urut']; ?> | <?= $dk['nama']; ?>"><i class="fas fa-fw fa-vote-yea"></i> Vote</a>
							</div>
						</div>	
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>

