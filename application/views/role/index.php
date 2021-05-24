<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col header-title">
        <h1 class="m-0 text-dark"><i class="fas fa-fw fa-user-graduate"></i> Role</h1>
      </div>
      <div class="col header-button">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRoleModal"><i class="fas fa-fw fa-plus"></i> Tambah Role</button>
      </div>
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
                <th>Role</th>
                <th style="width: 12.5rem">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($role as $dr): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $dr['role']; ?></td>
                  <td class="text-center">
                    <?php if ($dr['role'] != 'Administrator'): ?>
                      <button type="button" data-toggle="modal" data-target="#editRoleModal<?= $dr['id_role']; ?>" class="btn btn-sm btn-success m-1"><i class="fas fa-fw fa-edit"></i> Ubah</button>

                      <!-- Modal -->
                      <div class="modal fade text-left" id="editRoleModal<?= $dr['id_role']; ?>" tabindex="-1" aria-labelledby="editRoleModalLabel<?= $dr['id_role']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                          <form method="post" action="<?= base_url('role/editRole/' . $dr['id_role']); ?>">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editRoleModalLabel<?= $dr['id_role']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Role</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="role" class="font-weight-normal">Role</label>
                                  <input type="text" id="role" class="form-control <?= (form_error('role')) ? 'is-invalid' : ''; ?>" name="role" required value="<?= (form_error('role') ? set_value('role') : $dr['role']); ?>">
                                  <div class="invalid-feedback">
                                    <?= form_error('role'); ?>
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

                      <a href="<?= base_url('role/removeRole/' . $dr['id_role']); ?>" class="btn btn-sm btn-danger m-1 btn-delete" data-nama="<?= $dr['role']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                    <?php endif ?>
                  </td>
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
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addRoleModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="role" class="font-weight-normal">Role</label>
            <input type="text" id="role" class="form-control <?= (form_error('role')) ? 'is-invalid' : ''; ?>" name="role" required value="<?= set_value('role'); ?>">
            <div class="invalid-feedback">
              <?= form_error('role'); ?>
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
<!-- /.Modal -->
