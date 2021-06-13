<div class="container">
	<?php if (isset($row_periode)): ?>
		<div class="row my-3">
			<div class="col-lg">
				<h3>Pemilihan Presiden Masyarakat Periode <?= $row_periode['periode']; ?></h3>
				<div class="row my-3">
					<!-- get winner -->
					<?php 
						$max = [];
						foreach ($vote as $dv) 
						{
							// for perolehan suara
							$this->db->select('*, count(vote.id_mahasiswa) as perolehan_suara');
							$this->db->join('vote', 'vote.id_kandidat = kandidat.id_kandidat');
							$this->db->join('periode', 'periode.id_periode = vote.id_periode');
							$this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = vote.id_mahasiswa');
							$perolehan_suara = $this->db->get_where('kandidat', ['kandidat.id_kandidat' => $dv['id_kandidat'], 'vote.id_periode' => $dv['id_periode']])->row_array();
							$max[] = [
								'perolehan_suara' => $perolehan_suara['perolehan_suara'],
								'id_kandidat' => $perolehan_suara['id_kandidat']
							];
						}

						$winner = max($max);
						$this->db->select('*, mahasiswa.nama AS nama_mahasiswa, kandidat.nama AS nama_kandidat, periode.status AS status_periode');
						$this->db->join('mahasiswa', 'vote.id_mahasiswa = mahasiswa.id_mahasiswa');
						$this->db->join('rombel', 'mahasiswa.id_rombel = rombel.id_rombel');
						$this->db->join('jurusan', 'rombel.id_jurusan = jurusan.id_jurusan');
						$this->db->join('periode', 'vote.id_periode = periode.id_periode');
						$this->db->join('kandidat', 'kandidat.id_periode = periode.id_periode');
						$this->db->order_by('rombel.semester', 'asc');
						$this->db->order_by('jurusan.jurusan', 'asc');
						$this->db->order_by('mahasiswa.nama', 'asc');
						$this->db->order_by('kandidat.no_urut', 'asc');
						$kandidat_winner = $this->db->get_where('vote', ['vote.id_periode' => $row_periode['id_periode'], 'kandidat.id_kandidat' => $winner['id_kandidat']])->row_array();
					?>
					<!-- col winner -->
					<div class="col-lg p-3 mx-3 rounded bg-gold">
						<h3 class="text-center text-white text-shadow">Selamat!</h3>
						<div class="card text-dark m-3 mx-auto">
							<img src="<?= base_url('assets/img/img_candidates/') . $kandidat_winner['foto_kandidat']; ?>" class="card-img-top img-fluid" height="300" alt="Foto Kandidat">
							<div class="card-body text-center">
								<h3><small>No. Urut</small> <?= $kandidat_winner['no_urut']; ?></h3>
								<h5><?= $kandidat_winner['nama']; ?></h5>
								<div class="row my-3">
									<div class="col">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visiMisiModal<?= $kandidat_winner['id_kandidat']; ?>"><i class="fas fa-fw fa-bullseye"></i> Visi & Misi</button>
									</div>
								</div>
								<?php if ($row_periode['status'] == 'sudah_selesai'): ?>
									<div class="row my-3">
										<div class="col">
											<h5>
												Perolehan Suara: 
												<button type="button" class="btn btn-primary">
													<?= $winner['perolehan_suara']; ?>
												</button>
											</h5>
										</div>
									</div>
								<?php endif ?>

								<!-- Modal -->
								<div class="modal fade" id="visiMisiModal<?= $kandidat_winner['id_kandidat']; ?>" tabindex="-1" aria-labelledby="visiMisiModalLabel<?= $kandidat_winner['id_kandidat']; ?>" aria-hidden="true">
								  <div class="modal-dialog modal-lg">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="visiMisiModalLabel<?= $kandidat_winner['id_kandidat']; ?>">Kandidat No. <?= $kandidat_winner['no_urut']; ?> | <?= $kandidat_winner['nama']; ?></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body p-5">
										<img src="<?= base_url('assets/img/img_candidates/') . $kandidat_winner['foto_kandidat']; ?>" class="card-img-top img-fluid mb-3" alt="Foto Kandidat">
										<h3><?= $kandidat_winner['nama']; ?></h3>
										<hr style="width: 50%">
										<h4 class="text-left">Visi</h5>
										<p class="text-left"><?= $kandidat_winner['visi']; ?></p>
										<h4 class="text-left">Misi</h5>
										<p class="text-left"><?= $kandidat_winner['misi']; ?></p>
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
					<!-- ./col winner -->

					<!-- col loser -->
					<?php foreach ($vote as $dv): ?>
						<?php 
							// for perolehan suara
							$this->db->select('*, count(vote.id_mahasiswa) as perolehan_suara');
							$this->db->join('vote', 'vote.id_kandidat = kandidat.id_kandidat');
							$this->db->join('periode', 'periode.id_periode = vote.id_periode');
							$this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = vote.id_mahasiswa');
							$perolehan_suara = $this->db->get_where('kandidat', ['kandidat.id_kandidat' => $dv['id_kandidat'], 'vote.id_periode' => $dv['id_periode']])->row_array();
						?>	

						<?php if ($dv['id_kandidat'] != null): ?>
							<?php if ($dv['id_kandidat'] != $winner['id_kandidat']): ?>
								<div class="col-lg mx-3 pt-5">
									<div class="card text-dark m-3 mx-auto">
										<img src="<?= base_url('assets/img/img_candidates/') . $dv['foto_kandidat']; ?>" class="card-img-top img-fluid" height="300" alt="Foto Kandidat">
										<div class="card-body text-center">
											<h4><small>No. Urut</small> <?= $dv['no_urut']; ?></h4>
											<h6><?= $dv['nama']; ?></h6>
											<div class="row my-3">
												<div class="col">
													<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#visiMisiModal<?= $dv['id_kandidat']; ?>"><i class="fas fa-fw fa-bullseye"></i> Visi & Misi</button>
												</div>
											</div>
											<?php if ($row_periode['status'] == 'sudah_selesai'): ?>
												<div class="row my-3">
													<div class="col">
														<h6>
															Perolehan Suara: 
															<button type="button" class="btn btn-primary">
																<?php if ($perolehan_suara['perolehan_suara'] != '0'): ?>
																	<?= $perolehan_suara['perolehan_suara']; ?>
																<?php else: ?>
																	0
																<?php endif ?>
															</button>
														</h6>
													</div>
												</div>
											<?php endif ?>

											<!-- Modal -->
											<div class="modal fade" id="visiMisiModal<?= $dv['id_kandidat']; ?>" tabindex="-1" aria-labelledby="visiMisiModalLabel<?= $dv['id_kandidat']; ?>" aria-hidden="true">
											  <div class="modal-dialog modal-lg">
											    <div class="modal-content">
											      <div class="modal-header">
											        <h5 class="modal-title" id="visiMisiModalLabel<?= $dv['id_kandidat']; ?>">Kandidat No. <?= $dv['no_urut']; ?> | <?= $dv['nama']; ?></h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
											      <div class="modal-body p-5">
													<img src="<?= base_url('assets/img/img_candidates/') . $dv['foto_kandidat']; ?>" class="card-img-top img-fluid mb-3" height="300" alt="Foto Kandidat">
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
						<?php endif ?>
					<?php endforeach ?>
					<!-- col loser -->

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