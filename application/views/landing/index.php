<div class="container">
	<div class="row my-3">
		<div class="col-lg">
			<h2>Pemilihan Presiden Masyarakat Periode <?= $vote[0]['periode']; ?></h2>
			<a class="btn btn-primary" href="<?= base_url('landing/loginVote'); ?>">Vote</a>
			<div class="row my-3">
				<?php foreach ($vote as $dv): ?>
					<?php if ($dv['id_kandidat'] != null): ?>
						<div class="col-lg">
							<div class="card m-3 mx-auto" style="width: 300px">
								<img src="<?= base_url('assets/img/img_candidates/') . $dv['foto_kandidat']; ?>" class="card-img-top img-300" alt="Foto Kandidat">
								<div class="card-body text-center">
									<h2><small>No. Urut</small> <?= $dv['no_urut']; ?></h2>
									<h5><?= $dv['nama']; ?></h5>
									<div class="row my-3">
										<div class="col">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visiMisiModal<?= $dv['id_kandidat']; ?>"><i class="fas fa-fw fa-bullseye"></i> Visi & Misi</button>
										</div>
									</div>
									<?php if ($vote[0]['status'] == 'sudah_selesai'): ?>
										<div class="row my-3">
											<div class="col">
												Perolehan Suara: <button type="button" class="btn btn-primary"><?= $dv['perolehan_suara']; ?></button>
											</div>
										</div>
									<?php endif ?>

									<!-- Modal -->
									<div class="modal fade" id="visiMisiModal<?= $dv['id_kandidat']; ?>" tabindex="-1" aria-labelledby="visiMisiModalLabel<?= $dv['id_kandidat']; ?>" aria-hidden="true">
									  <div class="modal-dialog modal-lg modal-dialog-scrollable">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="visiMisiModalLabel<?= $dv['id_kandidat']; ?>">Kandidat No. <?= $dv['no_urut']; ?> | <?= $dv['nama']; ?></h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									      <div class="modal-body p-5">
											<img src="<?= base_url('assets/img/img_candidates/') . $dv['foto_kandidat']; ?>" class="card-img-top img-300 mb-3" alt="Foto Kandidat">
											<h3><?= $dv['nama']; ?></h3>
											<hr style="width: 50%">
											<h4 class="text-left">Visi</h5>
											<p class="text-left"><?= $dv['visi']; ?></p>
											<h4 class="text-left">Misi</h5>
											<p class="text-left"><?= $dv['misi']; ?></p>
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
									      </div>
									    </div>
									  </div>
									</div>
								</div>
							</div>
						</div>
					<?php endif ?>
				<?php endforeach ?>
			</div>
		</div>
	</div>

</div>