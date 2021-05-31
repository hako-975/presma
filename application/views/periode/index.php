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
        <h1 class="m-0 text-dark"><i class="fas fa-fw fa-calendar"></i> Periode</h1>
      </div>
      <?php if ($dataUser['role'] != 'Tamu'): ?>
        <div class="col header-button">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPeriodeModal"><i class="fas fa-fw fa-plus"></i> Tambah Periode</button>
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
                <th>Periode</th>
                <th>Status</th>
                <th>Aktif</th>
                <?php if ($dataUser['role'] != 'Tamu'): ?>
                  <th style="width: 12.5rem">Aksi</th>
                <?php endif ?>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($periode as $dp): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $dp['periode']; ?></td>
                  <?php 
                    $status = explode('_', $dp['status']);
                    $status = implode(' ', $status);
                    $status = ucwords(strtolower($status));
                  ?>
                  <td><?= $status; ?></td>

                  <?php if ($dp['aktif'] == 0): ?>
                    <td><button type="button" class="btn btn-danger">Tidak Aktif</button></td>
                  <?php else: ?>
                    <td><button type="button" class="btn btn-success">Aktif</button></td>
                  <?php endif ?>
                  <?php if ($dataUser['role'] != 'Tamu'): ?>
                    <td class="text-center">
                      <button type="button" data-toggle="modal" data-target="#editPeriodeModal<?= $dp['id_periode']; ?>" class="btn btn-sm btn-success m-1"><i class="fas fa-fw fa-edit"></i> Ubah</button>

                      <!-- Modal -->
                      <div class="modal fade text-left" id="editPeriodeModal<?= $dp['id_periode']; ?>" tabindex="-1" aria-labelledby="editPeriodeModalLabel<?= $dp['id_periode']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                          <form method="post" action="<?= base_url('periode/editPeriode/' . $dp['id_periode']); ?>">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editPeriodeModalLabel<?= $dp['id_periode']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Periode</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="dari_tahun<?= $dp['id_periode']; ?>" class="font-weight-normal">Dari Tahun</label>
                                      <?php 
                                        $dari_tahun = $dp['periode'];
                                        $dari_tahun = substr($dari_tahun, 0, 4);
                                      ?>
                                      <input type="number" min="0000" max="9999" step="1" id="dari_tahun<?= $dp['id_periode']; ?>" class="form-control <?= (form_error('dari_tahun')) ? 'is-invalid' : ''; ?>" name="dari_tahun" required value="<?= (form_error('dari_tahun') ? set_value('dari_tahun') : $dari_tahun); ?>">
                                      <div class="invalid-feedback">
                                        <?= form_error('dari_tahun'); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="sampai_tahun<?= $dp['id_periode']; ?>" class="font-weight-normal">Sampai Tahun</label>
                                      <?php 
                                        $sampai_tahun = $dp['periode'];
                                        $sampai_tahun = substr($sampai_tahun, 7, 4);
                                      ?>
                                      <input type="number" min="0000" max="9999" step="1" id="sampai_tahun<?= $dp['id_periode']; ?>" class="form-control <?= (form_error('sampai_tahun')) ? 'is-invalid' : ''; ?>" name="sampai_tahun" required value="<?= (form_error('sampai_tahun') ? set_value('sampai_tahun') : $sampai_tahun); ?>">
                                      <div class="invalid-feedback">
                                        <?= form_error('sampai_tahun'); ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="status<?= $dp['id_periode']; ?>" class="font-weight-normal">Status</label>
                                  <select id="status<?= $dp['id_periode']; ?>" class="custom-select <?= (form_error('status')) ? 'is-invalid' : ''; ?>" name="status" required>
                                    <?php if (set_value('status') != null): ?>
                                      <?php 
                                        $status_set_value = explode('_', set_value('status'));
                                        $status_set_value = implode(' ', $status_set_value);
                                        $status_set_value = ucwords(strtolower($status_set_value));
                                      ?>
                                      <option value="<?= set_value('status'); ?>"><?= $status_set_value; ?></option>
                                    <?php else: ?>
                                      <?php 
                                        $status_old = explode('_', $dp['status']);
                                        $status_old = implode(' ', $status_old);
                                        $status_old = ucwords(strtolower($status_old));
                                      ?>
                                      <option value="<?= $dp['status']; ?>"><?= $status_old; ?></option>
                                    <?php endif ?>
                                    <option disabled>------------------------</option>
                                    <option value="belum_selesai">Belum Selesai</option>
                                    <option value="sudah_selesai">Sudah Selesai</option>
                                  </select>
                                  <div class="invalid-feedback">
                                    <?= form_error('status'); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="form-group form-check">
                                    <?php if ($dp['aktif'] == 1): ?>
                                      <input type="checkbox" class="form-check-input" id="aktif<?= $dp['id_periode']; ?>" name="aktif" checked>
                                    <?php else: ?>
                                      <input type="checkbox" class="form-check-input" id="aktif<?= $dp['id_periode']; ?>" name="aktif">
                                    <?php endif ?>
                                    <label class="form-check-label" for="aktif<?= $dp['id_periode']; ?>">Aktif?</label>
                                  </div>
                                  <div class="invalid-feedback">
                                    <?= form_error('aktif'); ?>
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
                      <?php if ($dataUser['role'] == 'Administrator'): ?>
                        <a href="<?= base_url('periode/removePeriode/' . $dp['id_periode']); ?>" class="btn btn-sm btn-danger m-1 btn-delete" data-nama="<?= $dp['periode']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
<div class="modal fade" id="addPeriodeModal" tabindex="-1" aria-labelledby="addPeriodeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPeriodeModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Periode</h5>
 
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('periode'); ?>" class="close">
              <span aria-hidden="true">&times;</span>
            </a>
          <?php else: ?>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          <?php endif ?>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="dari_tahun" class="font-weight-normal">Dari Tahun</label>
                <input type="number" min="0000" max="9999" step="1" id="dari_tahun" class="form-control <?= (form_error('dari_tahun')) ? 'is-invalid' : ''; ?>" name="dari_tahun" required value="<?= (form_error('dari_tahun') ? set_value('dari_tahun') : date('Y')); ?>">
                <div class="invalid-feedback">
                  <?= form_error('dari_tahun'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="sampai_tahun" class="font-weight-normal">Sampai Tahun</label>
                <input type="number" min="0000" max="9999" step="1" id="sampai_tahun" class="form-control <?= (form_error('sampai_tahun')) ? 'is-invalid' : ''; ?>" name="sampai_tahun" required value="<?= (form_error('sampai_tahun') ? set_value('sampai_tahun') : date('Y') + 1); ?>">
                <div class="invalid-feedback">
                  <?= form_error('sampai_tahun'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="aktif" name="aktif" checked="checked">
              <label class="form-check-label" for="aktif">Aktif?</label>
            </div>
            <div class="invalid-feedback">
              <?= form_error('aktif'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('periode'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-times"></i> Tutup</a>
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
