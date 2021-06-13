<div class="container mt-5">
	<div class="row m-3 justify-content-center">
		<div class="col-lg-4 bg-white p-4 border rounded">
			<?php if ($this->uri->segment(3)): ?>
				<!-- check periode is active -->
				<?php 
					$periode = $this->db->get_where('periode', ['id_periode' => $this->uri->segment(3)])->row_array();
				?>
			<?php else: ?>
				<?php redirect("landing"); ?>
			<?php endif ?>
			<h4 class="text-center pt-2 pb-1">Masuk Vote</h4>
			<h5 class="text-center pb-2 pt-1">Periode <?= $periode['periode']; ?></h5>
			<form method="post" action="<?= base_url('landing/loginVote/' . $this->uri->segment(3)); ?>">
				<?php if ($periode['aktif'] == '1'): ?>
					<input type="hidden" name="id_periode" value="<?= $this->uri->segment(3); ?>">
				<?php else: ?>
					<?php redirect("landing"); ?>
				<?php endif ?>
				<div class="form-group">
					<label class="font-weight-normal" for="nim"><i class="fas fa-fw fa-user"></i> NIM</label>
					<input type="number" id="nim" class="rounded-pill form-control <?= (form_error('nim')) ? 'is-invalid' : ''; ?>" name="nim" required value="<?= set_value('nim'); ?>">
					<div class="invalid-feedback">
		              <?= form_error('nim'); ?>
		            </div>
				</div>
				<div class="form-group">
					<label class="font-weight-normal" for="password"><i class="fas fa-fw fa-lock"></i> Password</label>
					<input type="password" id="password" class="rounded-pill form-control <?= (form_error('password')) ? 'is-invalid' : ''; ?>" name="password" required value="<?= set_value('password'); ?>">
					<div class="invalid-feedback">
		              <?= form_error('password'); ?>
		            </div>
				</div>
				<div class="form-group text-right">
					<button type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-fw fa-sign-in-alt"></i> Masuk</button>
				</div>
			</form>
			<hr>
			<p style="font-size: 80%">Hak Cipta © 2021 Oleh Andri Firman Saputra.</p>
		</div>
	</div>
</div>