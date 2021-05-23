<div class="container mt-5 pt-5">
	<div class="row my-3 justify-content-center">
		<div class="col-lg-4 border border-dark p-4 rounded">
			<h3>Masuk</h3>
			<form method="post">
				<div class="form-group">
					<label class="font-weight-normal" for="username"><i class="fas fa-fw fa-user"></i> Username</label>
					<input type="text" id="username" class="form-control <?= (form_error('username')) ? 'is-invalid' : ''; ?>" name="username" required value="<?= set_value('username'); ?>">
					<div class="invalid-feedback">
		              <?= form_error('username'); ?>
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