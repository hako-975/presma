<div class="container mt-5">
	<div class="row mx-5 my-3 justify-content-center">
		<div class="col-lg-4 bg-white p-4 border rounded">
			<h4 class="text-center py-3">Masuk Admin</h4>
			<form method="post">
				<div class="form-group">
					<label class="font-weight-normal" for="username"><i class="fas fa-fw fa-user"></i> Username</label>
					<input type="text" id="username" class="rounded-pill form-control <?= (form_error('username')) ? 'is-invalid' : ''; ?>" name="username" required value="<?= set_value('username'); ?>">
					<div class="invalid-feedback">
		              <?= form_error('username'); ?>
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
					<button type="submit" class="rounded-pill btn btn-primary"><i class="fas fa-fw fa-sign-in-alt"></i> Masuk</button>
				</div>
			</form>
			<hr>
			<p style="font-size: 80%">Hak Cipta © 2021 Oleh Andri Firman Saputra.</p>
		</div>
	</div>
</div>