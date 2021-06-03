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
        <h1 class="m-0 text-dark"><i class="fas fa-fw fa-users"></i> Mahasiswa</h1>
      </div>
      <?php if ($dataUser['role'] != 'Tamu'): ?>
        <div class="col header-button">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMahasiswaModal"><i class="fas fa-fw fa-plus"></i> Tambah Mahasiswa</button>
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
                <th>NIM</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Rombel</th>
                <?php if ($dataUser['role'] != 'Tamu'): ?>
                  <th style="width: 12.5rem">Aksi</th>
                <?php endif ?>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($mahasiswa as $dm): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $dm['nim']; ?></td>
                  <td><?= $dm['nama']; ?></td>
                  <td><?= date('d-m-Y', strtotime($dm['tgl_lahir'])); ?></td>
                  <td><?= $dm['jurusan']; ?>, semester <?= $dm['semester']; ?></td>
                  <?php if ($dataUser['role'] != 'Tamu'): ?>
                    <td class="text-center">
                      <button type="button" data-toggle="modal" data-target="#editMahasiswaModal<?= $dm['id_mahasiswa']; ?>" class="btn btn-sm btn-success m-1"><i class="fas fa-fw fa-edit"></i> Ubah</button>

                      <!-- Modal -->
                      <div class="modal fade text-left" id="editMahasiswaModal<?= $dm['id_mahasiswa']; ?>" tabindex="-1" aria-labelledby="editMahasiswaModalLabel<?= $dm['id_mahasiswa']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                          <form method="post" action="<?= base_url('mahasiswa/editMahasiswa/' . $dm['id_mahasiswa']); ?>">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editMahasiswaModalLabel<?= $dm['id_mahasiswa']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Mahasiswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="nim<?= $dm['id_mahasiswa']; ?>" class="font-weight-normal">NIM</label>
                                  <input type="number" id="nim<?= $dm['id_mahasiswa']; ?>" class="form-control <?= (form_error('nim')) ? 'is-invalid' : ''; ?>" name="nim" required value="<?= (form_error('nim') ? set_value('nim') : $dm['nim']); ?>">
                                  <div class="invalid-feedback">
                                    <?= form_error('nim'); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="nama<?= $dm['id_mahasiswa']; ?>" class="font-weight-normal">Nama</label>
                                  <input type="text" id="nama<?= $dm['id_mahasiswa']; ?>" class="form-control <?= (form_error('nama')) ? 'is-invalid' : ''; ?>" name="nama" required value="<?= (form_error('nama') ? set_value('nama') : $dm['nama']); ?>">
                                  <div class="invalid-feedback">
                                    <?= form_error('nama'); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="tgl_lahir<?= $dm['id_mahasiswa']; ?>" class="font-weight-normal">Tanggal Lahir</label>
                                  <input type="date" id="tgl_lahir<?= $dm['id_mahasiswa']; ?>" class="form-control <?= (form_error('tgl_lahir')) ? 'is-invalid' : ''; ?>" name="tgl_lahir" required value="<?= (form_error('tgl_lahir') ? set_value('tgl_lahir') : $dm['tgl_lahir']); ?>">
                                  <div class="invalid-feedback">
                                    <?= form_error('tgl_lahir'); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="id_rombel<?= $dm['id_mahasiswa']; ?>" class="font-weight-normal">Rombel</label>
                                  <select id="id_rombel<?= $dm['id_mahasiswa']; ?>" class="custom-select <?= (form_error('id_rombel')) ? 'is-invalid' : ''; ?>" name="id_rombel" required>
                                    <?php if (set_value('id_rombel') != null): ?>
                                      <?php 
                                        $id_rombel_old = set_value('id_rombel');
                                        $rombel_old = $this->db->get_where('rombel', ['id_rombel' => $id_rombel_old])->row_array();
                                      ?>
                                      <option value="<?= set_value('id_rombel'); ?>"><?= $rombel_old['jurusan']; ?>, semester <?= $rombel_old['semester']; ?></option>
                                    <?php else: ?>
                                      <option value="<?= $dm['id_rombel']; ?>"><?= $dm['jurusan']; ?>, semester <?= $dm['semester']; ?></option>
                                    <?php endif ?>
                                    <?php foreach ($rombel as $dr): ?>
                                      <?php if ($dm['id_rombel'] != $dr['id_rombel']): ?>
                                        <option value="<?= $dr['id_rombel']; ?>"><?= $dr['jurusan']; ?>, semester <?= $dr['semester']; ?></option>
                                      <?php endif ?>
                                    <?php endforeach ?>
                                  </select>
                                  <div class="invalid-feedback">
                                    <?= form_error('id_rombel'); ?>
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


                      <a href="<?= base_url('mahasiswa/removeMahasiswa/' . $dm['id_mahasiswa']); ?>" class="btn btn-sm btn-danger m-1 btn-delete" data-nama="<?= $dm['nama']; ?> dengan NIM <?= $dm['nim']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
<div class="modal fade" id="addMahasiswaModal" tabindex="-1" aria-labelledby="addMahasiswaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMahasiswaModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Mahasiswa</h5>
 
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('mahasiswa'); ?>" class="close">
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
            <label for="nim" class="font-weight-normal">NIM</label>
            <input type="number" id="nim" class="form-control <?= (form_error('nim')) ? 'is-invalid' : ''; ?>" name="nim" required value="<?= set_value('nim'); ?>">
            <div class="invalid-feedback">
              <?= form_error('nim'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="nama" class="font-weight-normal">Nama</label>
            <input type="text" id="nama" class="form-control <?= (form_error('nama')) ? 'is-invalid' : ''; ?>" name="nama" required value="<?= set_value('nama'); ?>">
            <div class="invalid-feedback">
              <?= form_error('nama'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="tgl_lahir" class="font-weight-normal">Tanggal Lahir</label>
            <input type="date" id="tgl_lahir" class="form-control <?= (form_error('tgl_lahir')) ? 'is-invalid' : ''; ?>" name="tgl_lahir" required value="<?= set_value('tgl_lahir'); ?>">
            <div class="invalid-feedback">
              <?= form_error('tgl_lahir'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="id_rombel" class="font-weight-normal">Rombel</label>
            <select id="id_rombel" class="custom-select <?= (form_error('id_rombel')) ? 'is-invalid' : ''; ?>" name="id_rombel" required>
              <?php if (set_value('id_rombel') != null): ?>
                <?php 
                  $id_rombel_old = set_value('id_rombel');
                  $this->db->join('jurusan', 'rombel.id_jurusan = jurusan.id_jurusan');
                  $rombel_old = $this->db->get_where('rombel', ['id_rombel' => $id_rombel_old])->row_array();
                ?>
                <option value="<?= set_value('id_rombel'); ?>"><?= $rombel_old['jurusan']; ?>, semester <?= $rombel_old['semester']; ?></option>
              <?php endif ?>
              <?php foreach ($rombel as $dr): ?>
                <?php if (set_value('id_rombel') != null): ?>
                  <?php if ($id_rombel_old != $dr['id_rombel']): ?>
                    <option value="<?= $dr['id_rombel']; ?>"><?= $dr['jurusan']; ?>, semester <?= $dr['semester']; ?></option>
                  <?php endif ?>
                <?php else: ?>
                  <option value="<?= $dr['id_rombel']; ?>"><?= $dr['jurusan']; ?>, semester <?= $dr['semester']; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <div class="invalid-feedback">
              <?= form_error('id_rombel'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('mahasiswa'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-times"></i> Tutup</a>
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
