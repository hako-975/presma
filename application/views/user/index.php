<?php 
if (isset($behavior)) 
{
  echo "
    <script>
      $(document).ready(function() {
        $('#$behavior').modal('show');
      });
    </script>
  ";
}

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col header-title">
        <h4 class="m-0 text-dark"><i class="fas fa-fw fa-user"></i> Pengguna</h4>
      </div>
      <?php if ($dataUser['role'] == 'Administrator'): ?>
        <div class="col header-button">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal"><small><i class="fas fa-fw fa-plus"></i> Tambah Pengguna</small></button>
        </div>
      <?php endif ?>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    
    <?php if (validation_errors()): ?>
      <div class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" style="z-index: 999999; position: fixed; right: 1.5rem; bottom: 1.5rem">
        <div class="toast-header">
          <strong class="mr-auto">Gagal!</strong>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          <?= validation_errors(); ?>
        </div>
      </div>
    <?php endif ?>

    <div class="row my-3">
      <div class="col-lg">
        <div class="table-responsive">
          <table class="table table-bordered" id="table_id">
            <thead class="thead-dark">
              <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Jabatan</th>
                <?php if ($dataUser['role'] == 'Administrator'): ?>
                  <th style="width: 12.5rem">Aksi</th>
                <?php endif ?>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($user as $du): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $du['username']; ?></td>
                  <td><?= $du['role']; ?></td>
                  <?php if ($dataUser['role'] == 'Administrator'): ?>
                    <td class="text-center">
                      <?php if ($du['role'] != 'Administrator'): ?>
                        <button type="button" data-toggle="modal" data-target="#editUserModal<?= $du['id_user']; ?>" class="btn btn-sm btn-success m-1"><i class="fas fa-fw fa-edit"></i> Ubah</button>

                        <!-- Modal -->
                        <div class="modal fade text-left" id="editUserModal<?= $du['id_user']; ?>" tabindex="-1" aria-labelledby="editUserModalLabel<?= $du['id_user']; ?>" aria-hidden="true">
                          <div class="modal-dialog">
                            <form method="post" action="<?= base_url('user/editUser/' . $du['id_user']); ?>">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="editUserModalLabel<?= $du['id_user']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Pengguna</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="username<?= $du['id_user']; ?>" class="font-weight-normal">Username</label>
                                    <input type="text" id="username<?= $du['id_user']; ?>" class="form-control <?= (form_error('username')) ? 'is-invalid' : ''; ?>" name="username" required value="<?= (form_error('username') ? set_value('username') : $du['username']); ?>">
                                    <div class="invalid-feedback">
                                      <?= form_error('username'); ?>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="id_role<?= $du['id_user']; ?>" class="font-weight-normal">Jabatan</label>
                                    <select id="id_role<?= $du['id_user']; ?>" class="custom-select <?= (form_error('id_role')) ? 'is-invalid' : ''; ?>" name="id_role" required>
                                      <?php if (set_value('id_role') != null): ?>
                                        <?php 
                                          $id_role_old = set_value('id_role');
                                          $role_old = $this->db->get_where('role', ['id_role' => $id_role_old])->row_array();
                                        ?>
                                        <option value="<?= set_value('id_role'); ?>"><?= $role_old['role']; ?></option>
                                      <?php else: ?>
                                        <option value="<?= $du['id_role']; ?>"><?= $du['role']; ?></option>
                                      <?php endif ?>
                                      <?php foreach ($role as $dr): ?>
                                        <?php if ($dr['role'] != 'Administrator'): ?>
                                          <?php if ($du['id_role'] != $dr['id_role']): ?>
                                            <option value="<?= $dr['id_role']; ?>"><?= $dr['role']; ?></option>
                                          <?php endif ?>
                                        <?php endif ?>
                                      <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                      <?= form_error('id_role'); ?>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
                                  <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>

                        <a href="<?= base_url('user/removeUser/' . $du['id_user']); ?>" class="btn btn-sm btn-danger m-1 btn-delete" data-nama="<?= $du['username']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                      <?php endif ?>
                    </td>
                  <?php endif ?>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUserModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Pengguna</h5>
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('user'); ?>" class="close">
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
            <label for="username" class="font-weight-normal">Username</label>
            <input type="text" id="username" class="form-control <?= (form_error('username')) ? 'is-invalid' : ''; ?>" name="username" required value="<?= set_value('username'); ?>">
            <div class="invalid-feedback">
              <?= form_error('username'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="font-weight-normal">Password</label>
            <input type="password" id="password" class="form-control <?= (form_error('password')) ? 'is-invalid' : ''; ?>" name="password" required>
            <div class="invalid-feedback">
              <?= form_error('password'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="password_verify" class="font-weight-normal">Verifikasi Password</label>
            <input type="password" id="password_verify" class="form-control <?= (form_error('password_verify')) ? 'is-invalid' : ''; ?>" name="password_verify" required>
            <div class="invalid-feedback">
              <?= form_error('password_verify'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="id_role" class="font-weight-normal">Jabatan</label>
            <select id="id_role" class="custom-select <?= (form_error('id_role')) ? 'is-invalid' : ''; ?>" name="id_role" required>
              <?php if (set_value('id_role') != null): ?>
                <?php 
                  $id_role_old = set_value('id_role');
                  $role_old = $this->db->get_where('role', ['id_role' => $id_role_old])->row_array();
                ?>
                <option value="<?= set_value('id_role'); ?>"><?= $role_old['role']; ?></option>
              <?php endif ?>
              <?php foreach ($role as $dr): ?>
                <?php if ($dr['role'] != 'Administrator'): ?>
                  <?php if (set_value('id_role') != null): ?>
                    <?php if ($id_role_old != $dr['id_role']): ?>
                      <option value="<?= $dr['id_role']; ?>"><?= $dr['role']; ?></option>
                    <?php endif ?>
                  <?php else: ?>
                    <option value="<?= $dr['id_role']; ?>"><?= $dr['role']; ?></option>
                  <?php endif ?>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <div class="invalid-feedback">
              <?= form_error('id_role'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('user'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-times"></i> Tutup</a>
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
