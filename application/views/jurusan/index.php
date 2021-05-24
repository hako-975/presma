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
        <h1 class="m-0 text-dark"><i class="fas fa-fw fa-user-graduate"></i> Jurusan</h1>
      </div>
      <div class="col header-button">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addJurusanModal"><i class="fas fa-fw fa-plus"></i> Tambah Jurusan</button>
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
                <th>Jurusan</th>
                <th style="width: 12.5rem">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($jurusan as $dj): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $dj['jurusan']; ?></td>
                  <td class="text-center">
                    <button type="button" data-toggle="modal" data-target="#editJurusanModal<?= $dj['id_jurusan']; ?>" class="btn btn-sm btn-success m-1"><i class="fas fa-fw fa-edit"></i> Ubah</button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="editJurusanModal<?= $dj['id_jurusan']; ?>" tabindex="-1" aria-labelledby="editJurusanModalLabel<?= $dj['id_jurusan']; ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <form method="post" action="<?= base_url('jurusan/editJurusan/' . $dj['id_jurusan']); ?>">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editJurusanModalLabel<?= $dj['id_jurusan']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Jurusan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="jurusan<?= $dj['id_jurusan']; ?>" class="font-weight-normal">Jurusan</label>
                                <input type="text" id="jurusan<?= $dj['id_jurusan']; ?>" class="form-control <?= (form_error('jurusan')) ? 'is-invalid' : ''; ?>" name="jurusan" required value="<?= (form_error('jurusan') ? set_value('jurusan') : $dj['jurusan']); ?>">
                                <div class="invalid-feedback">
                                  <?= form_error('jurusan'); ?>
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


                    <a href="<?= base_url('jurusan/removeJurusan/' . $dj['id_jurusan']); ?>" class="btn btn-sm btn-danger m-1 btn-delete" data-nama="<?= $dj['jurusan']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
<div class="modal fade" id="addJurusanModal" tabindex="-1" aria-labelledby="addJurusanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addJurusanModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Jurusan</h5>
 
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('jurusan'); ?>" class="close">
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
            <label for="jurusan" class="font-weight-normal">Jurusan</label>
            <input type="text" id="jurusan" class="form-control <?= (form_error('jurusan')) ? 'is-invalid' : ''; ?>" name="jurusan" required value="<?= set_value('jurusan'); ?>">
            <div class="invalid-feedback">
              <?= form_error('jurusan'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('jurusan'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-times"></i> Tutup</a>
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