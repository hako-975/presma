<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col header-title">
        <h1 class="m-0 text-dark"><i class="fas fa-fw fa-user"></i> Profil</h1>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row my-3">
      <div class="col-lg-6">
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Username:</b> <?= $dataUser['username']; ?></li>
            <li class="list-group-item"><b>Jabatan:</b> <?= $dataUser['role']; ?></li>
            <li class="list-group-item"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#changePasswordModal"><i class="fas fa-fw fa-lock"></i> Ganti Password</button></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel"><i class="fas fa-fw fa-edit"></i> Ganti Password</h5>
 
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('profile'); ?>" class="close">
              <span aria-hidden="true">&times;</span>
            </a>
          <?php else: ?>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          <?php endif ?>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="old_password" class="font-weight-normal">Password Lama</label>
            <input type="password" id="old_password" class="form-control <?= (form_error('old_password')) ? 'is-invalid' : ''; ?>" name="old_password" required value="<?= set_value('old_password'); ?>">
            <div class="invalid-feedback">
              <?= form_error('old_password'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="new_password" class="font-weight-normal">Password Baru</label>
            <input type="password" id="new_password" class="form-control <?= (form_error('new_password')) ? 'is-invalid' : ''; ?>" name="new_password" required value="<?= set_value('new_password'); ?>">
            <div class="invalid-feedback">
              <?= form_error('new_password'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="new_password_verify" class="font-weight-normal">Verifikasi Password Baru</label>
            <input type="password" id="new_password_verify" class="form-control <?= (form_error('new_password_verify')) ? 'is-invalid' : ''; ?>" name="new_password_verify" required value="<?= set_value('new_password_verify'); ?>">
            <div class="invalid-feedback">
              <?= form_error('new_password_verify'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('profile'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-times"></i> Tutup</a>
          <?php else: ?>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
          <?php endif ?>
          <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- /.Modal -->