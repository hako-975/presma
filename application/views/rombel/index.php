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
        <h1 class="m-0 text-dark"><i class="fas fa-fw fa-user-friends"></i> Rombel</h1>
      </div>
      <div class="col header-button">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRombelModal"><i class="fas fa-fw fa-plus"></i> Tambah Rombel</button>
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
                <th>Semester</th>
                <th style="width: 12.5rem">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($rombel as $dr): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $dr['jurusan']; ?></td>
                  <td><?= $dr['semester']; ?></td>
                  <td class="text-center">
                    <button type="button" data-toggle="modal" data-target="#editRombelModal<?= $dr['id_rombel']; ?>" class="btn btn-sm btn-success m-1"><i class="fas fa-fw fa-edit"></i> Ubah</button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="editRombelModal<?= $dr['id_rombel']; ?>" tabindex="-1" aria-labelledby="editRombelModalLabel<?= $dr['id_rombel']; ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <form method="post" action="<?= base_url('rombel/editRombel/' . $dr['id_rombel']); ?>">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editRombelModalLabel<?= $dr['id_rombel']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Rombel</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="id_jurusan<?= $dr['id_rombel']; ?>" class="font-weight-normal">Jurusan</label>
                                <select id="id_jurusan<?= $dr['id_rombel']; ?>" class="custom-select <?= (form_error('id_jurusan')) ? 'is-invalid' : ''; ?>" name="id_jurusan" required>
                                  <?php if (set_value('id_jurusan') != null): ?>
                                    <?php 
                                      $id_jurusan_old = set_value('id_jurusan');
                                      $jurusan_old = $this->db->get_where('jurusan', ['id_jurusan' => $id_jurusan_old])->row_array();
                                    ?>
                                    <option value="<?= set_value('id_jurusan'); ?>"><?= $jurusan_old['jurusan']; ?></option>
                                  <?php else: ?>
                                    <option value="<?= $dr['id_jurusan']; ?>"><?= $dr['jurusan']; ?></option>
                                  <?php endif ?>
                                  <?php foreach ($jurusan as $dj): ?>
                                    <?php if ($dj['jurusan'] != 'Administrator'): ?>
                                      <?php if ($dr['id_jurusan'] != $dj['id_jurusan']): ?>
                                        <option value="<?= $dj['id_jurusan']; ?>"><?= $dj['jurusan']; ?></option>
                                      <?php endif ?>
                                    <?php endif ?>
                                  <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                  <?= form_error('id_jurusan'); ?>
                                </div>
                                <small class="text-primary"><a href="<?= base_url('jurusan/setFlashData/addJurusanModal'); ?>">Tidak ada jurusan yang dicari? tambahkan!</a></small>
                              </div>
                              <div class="form-group">
                                <label for="semester<?= $dr['id_rombel']; ?>" class="font-weight-normal">Semester</label>
                                <input type="number" id="semester<?= $dr['id_rombel']; ?>" class="form-control <?= (form_error('semester')) ? 'is-invalid' : ''; ?>" name="semester" required value="<?= (form_error('semester') ? set_value('semester') : $dr['semester']); ?>">
                                <div class="invalid-feedback">
                                  <?= form_error('semester'); ?>
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
                      <a href="<?= base_url('rombel/removeRombel/' . $dr['id_rombel']); ?>" class="btn btn-sm btn-danger m-1 btn-delete" data-nama="<?= $dr['jurusan']; ?> semester <?= $dr['semester']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
<div class="modal fade" id="addRombelModal" tabindex="-1" aria-labelledby="addRombelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addRombelModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Rombel</h5>
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('rombel'); ?>" class="close">
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
            <label for="id_jurusan" class="font-weight-normal">Jurusan</label>
            <select id="id_jurusan" class="custom-select <?= (form_error('id_jurusan')) ? 'is-invalid' : ''; ?>" name="id_jurusan" required>
              <?php if (set_value('id_jurusan') != null): ?>
                <?php 
                  $id_jurusan_old = set_value('id_jurusan');
                  $jurusan_old = $this->db->get_where('jurusan', ['id_jurusan' => $id_jurusan_old])->row_array();
                ?>
                <option value="<?= set_value('id_jurusan'); ?>"><?= $jurusan_old['jurusan']; ?></option>
              <?php endif ?>
              <?php foreach ($jurusan as $dj): ?>
                <?php if (set_value('id_jurusan') != null): ?>
                  <?php if ($id_jurusan_old != $dj['id_jurusan']): ?>
                    <option value="<?= $dj['id_jurusan']; ?>"><?= $dj['jurusan']; ?></option>
                  <?php endif ?>
                <?php else: ?>
                  <option value="<?= $dj['id_jurusan']; ?>"><?= $dj['jurusan']; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <div class="invalid-feedback">
              <?= form_error('id_jurusan'); ?>
            </div>
            <small class="text-primary"><a href="<?= base_url('jurusan/setFlashData/addJurusanModal'); ?>">Tidak ada jurusan yang dicari? tambahkan!</a></small>
          </div>
          <div class="form-group">
            <label for="semester" class="font-weight-normal">Semester</label>
            <input type="number" id="semester" class="form-control <?= (form_error('semester')) ? 'is-invalid' : ''; ?>" name="semester" required value="<?= set_value('semester'); ?>">
            <div class="invalid-feedback">
              <?= form_error('semester'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('rombel'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-times"></i> Tutup</a>
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
