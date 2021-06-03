<div class="container">
	<?php if (isset($row_periode)): ?>
		<div class="row my-3">
			<div class="col-lg">
				<h2>Pemilihan Presiden Masyarakat Periode <?= $row_periode['periode']; ?></h2>
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
										<?php if ($row_periode['status'] == 'sudah_selesai'): ?>
											<?php 
												$this->db->select('*, count(vote.id_mahasiswa) as perolehan_suara');
												$this->db->join('vote', 'vote.id_kandidat = kandidat.id_kandidat');
												$this->db->join('periode', 'periode.id_periode = vote.id_periode');
												$this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = vote.id_mahasiswa');
												$perolehan_suara = $this->db->get_where('kandidat', ['kandidat.id_kandidat' => $dv['id_kandidat'], 'vote.id_periode' => $dv['id_periode']])->row_array();
											?>
											<div class="row my-3">
												<div class="col">
													Perolehan Suara: 
													<button type="button" class="btn btn-primary">
														<?php if ($perolehan_suara['perolehan_suara'] != '0'): ?>
															<?= $perolehan_suara['perolehan_suara']; ?>
														<?php else: ?>
															0
														<?php endif ?>
													</button>
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
				<?php if ($row_periode['status'] == 'belum_selesai'): ?>
					<div class="row justify-content-center my-3">
						<div class="col-lg text-center">
							<a class="btn btn-primary btn-lg" href="<?= base_url('landing/loginVote/') . $row_periode['id_periode']; ?>"><i class="fas fa-fw fa-vote-yea"></i> Vote</a>
						</div>
					</div>
				<?php endif ?>	
			</div>
		</div>
	<?php else: ?>
		<div class="row my-3">
			<div class="col-lg">
				<h2>Belum ada Pemilihan Presiden Mahasiswa</h2>
			</div>
		</div>	
	<?php endif ?>
	<!-- <div class="row">
		<div class="col-lg">
			<p>Untuk para mahasiswa pilihlah calon presiden mahasiswa sesuai dengan hati nurani kalian, bukan karena suruhan ataupun sogokan.</p>
		</div>
	</div> -->
</div>