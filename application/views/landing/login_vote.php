<div class="container mt-5 pt-5">
	<div class="row my-3 justify-content-center">
		<div class="col-lg-4 border border-dark p-4 rounded">
			<h3>Masuk Vote</h3>
			<form method="post" action="<?= base_url('landing/loginVote/' . $this->uri->segment(3)); ?>">
				<?php if ($this->uri->segment(3)): ?>
					<!-- check periode is active -->
					<?php 
						$periode = $this->db->get_where('periode', ['id_periode' => $this->uri->segment(3)])->row_array();
					?>
					<?php if ($periode['aktif'] == '1'): ?>
						<input type="hidden" name="id_periode" value="<?= $this->uri->segment(3); ?>">
					<?php else: ?>
						<?php redirect("landing"); ?>
					<?php endif ?>
				<?php else: ?>
					<?php redirect("landing"); ?>
				<?php endif ?>
				<div class="form-group">
					<label class="font-weight-normal" for="nim"><i class="fas fa-fw fa-user"></i> NIM</label>
					<input type="number" id="nim" class="form-control <?= (form_error('nim')) ? 'is-invalid' : ''; ?>" name="nim" required value="<?= set_value('nim'); ?>">
					<div class="invalid-feedback">
		              <?= form_error('nim'); ?>
		            </div>
				</div>
				<div class="form-group">
					<label class="font-weight-normal" for="password"><i class="fas fa-fw fa-lock"></i> Password</label>
					<input type="password" id="password" class="form-control <?= (form_error('password')) ? 'is-invalid' : ''; ?>" name="password" required value="<?= set_value('password'); ?>">
					<div class="invalid-feedback">
		              <?= form_error('password'); ?>
		            </div>
				</div>
				<div class="form-group text-right">
					<button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-sign-in-alt"></i> Masuk</button>
				</div>
			</form>
		</div>
	</div>
</div>