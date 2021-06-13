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
        <h4 class="m-0 text-dark"><i class="fas fa-fw fa-user-tie"></i> Kandidat</h4>
      </div>
      <?php if ($dataUser['role'] != 'Tamu'): ?>
        <div class="col header-button">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addKandidatModal"><small><i class="fas fa-fw fa-plus"></i> Tambah Kandidat</small></button>
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
                <th class="text-center">No.</th>
                <th class="text-center">Foto</th>
                <th class="text-center">NIM</th>
                <th class="text-center">Nama</th>
                <th style="width: 50rem">Visi</th>
                <th style="width: 50rem">Misi</th>
                <th class="text-center">No. Urut</th>
                <th class="text-center">Periode</th>
                <?php if ($dataUser['role'] != 'Tamu'): ?>
                  <th style="width: 12.5rem">Aksi</th>
                <?php endif ?>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($kandidat as $dk): ?>
                <tr>
                  <td class="text-center"><?= $i++; ?></td>
                  <td class="text-center">
                    <a href="<?= base_url('assets/img/img_candidates/') . $dk['foto_kandidat']; ?>" class="enlarge">
                      <img class="img-fluid img-w-100" src="<?= base_url('assets/img/img_candidates/') . $dk['foto_kandidat']; ?>" alt="<?= $dk['foto_kandidat']; ?>">
                    </a>
                  </td>
                  <td class="text-center"><?= $dk['nim']; ?></td>
                  <td class="text-center"><?= $dk['nama']; ?></td>
                  <?php if (strlen($dk['visi']) > 100): ?>
                    <td><?= substr($dk['visi'], 0, 100); ?>...</td>
                  <?php else: ?>
                    <td><?= $dk['visi']; ?></td>
                  <?php endif ?>
                  <?php if (strlen($dk['misi']) > 100): ?>
                    <td><?= substr($dk['misi'], 0, 100); ?>...</td>
                  <?php else: ?>
                    <td><?= $dk['misi']; ?></td>
                  <?php endif ?>
                  <td class="text-center"><?= $dk['no_urut']; ?></td>
                  <td class="text-center"><?= $dk['periode']; ?></td>
                  <?php if ($dataUser['role'] != 'Tamu'): ?>
                    <td class="text-center">
                      <button type="button" data-toggle="modal" data-target="#editKandidatModal<?= $dk['id_kandidat']; ?>" class="btn btn-sm btn-success m-1"><i class="fas fa-fw fa-edit"></i> Ubah</button>

                      <!-- Modal -->
                      <div class="modal fade text-left" id="editKandidatModal<?= $dk['id_kandidat']; ?>" tabindex="-1" aria-labelledby="editKandidatModalLabel<?= $dk['id_kandidat']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                          <form method="post" action="<?= base_url('kandidat/editKandidat/' . $dk['id_kandidat']); ?>" enctype="multipart/form-data">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editKandidatModalLabel<?= $dk['id_kandidat']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Kandidat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="nim<?= $dk['id_kandidat']; ?>" class="font-weight-normal">NIM</label>
                                  <input type="number" id="nim<?= $dk['id_kandidat']; ?>" class="form-control <?= (form_error('nim')) ? 'is-invalid' : ''; ?>" name="nim" required value="<?= (form_error('nim') ? set_value('nim') : $dk['nim']); ?>">
                                  <div class="invalid-feedback">
                                    <?= form_error('nim'); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="nama<?= $dk['id_kandidat']; ?>" class="font-weight-normal">Nama</label>
                                  <input type="text" id="nama<?= $dk['id_kandidat']; ?>" class="form-control <?= (form_error('nama')) ? 'is-invalid' : ''; ?>" name="nama" required value="<?= (form_error('nama') ? set_value('nama') : $dk['nama']); ?>">
                                  <div class="invalid-feedback">
                                    <?= form_error('nama'); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="visi<?= $dk['id_kandidat']; ?>" class="font-weight-normal">Visi</label>
                                  <textarea id="visi<?= $dk['id_kandidat']; ?>" class="form-control <?= (form_error('visi')) ? 'is-invalid' : ''; ?>" name="visi" required><?= (form_error('visi') ? set_value('visi') : $dk['visi']); ?></textarea>
                                  <div class="invalid-feedback">
                                    <?= form_error('visi'); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="misi<?= $dk['id_kandidat']; ?>" class="font-weight-normal">Misi</label>
                                  <textarea id="misi<?= $dk['id_kandidat']; ?>" class="form-control <?= (form_error('misi')) ? 'is-invalid' : ''; ?>" name="misi" required><?= (form_error('misi') ? set_value('misi') : $dk['misi']); ?></textarea>
                                  <div class="invalid-feedback">
                                    <?= form_error('misi'); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-lg-4 text-center">
                                      <a href="<?= base_url('assets/img/img_candidates/') . $dk['foto_kandidat']; ?>" class="enlarge check_enlarge_photo">
                                        <img class="img-fluid rounded check_photo" src="<?= base_url('assets/img/img_candidates/') . $dk['foto_kandidat']; ?>" alt="foto kandidat">
                                      </a>
                                      <small class="d-block">Klik foto untuk perbesar</small>
                                    </div>
                                    <div class="col-lg">
                                      <div class="input-group mb-3">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input photo" id="foto_kandidat<?= $dk['id_kandidat']; ?>" name="foto_kandidat">
                                          <label class="custom-file-label" for="foto_kandidat<?= $dk['id_kandidat']; ?>">Pilih File</label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="no_urut<?= $dk['id_kandidat']; ?>" class="font-weight-normal">No. Urut</label>
                                  <input type="number" id="no_urut<?= $dk['id_kandidat']; ?>" class="form-control <?= (form_error('no_urut')) ? 'is-invalid' : ''; ?>" name="no_urut" required value="<?= (form_error('no_urut') ? set_value('no_urut') : $dk['no_urut']); ?>">
                                  <div class="invalid-feedback">
                                    <?= form_error('no_urut'); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="id_periode" class="font-weight-normal">Periode</label>
                                  <select id="id_periode" class="custom-select <?= (form_error('id_periode')) ? 'is-invalid' : ''; ?>" name="id_periode" required>
                                    <?php if (set_value('id_periode') != null): ?>
                                      <?php 
                                        $id_periode_old = set_value('id_periode');
                                        $periode_old = $this->db->get_where('periode', ['id_periode' => $id_periode_old])->row_array();
                                      ?>
                                      <option value="<?= set_value('id_periode'); ?>"><?= $periode_old['periode']; ?></option>
                                    <?php else: ?>
                                      <option value="<?= $dk['id_periode']; ?>"><?= $dk['periode']; ?></option>
                                    <?php endif ?>
                                    <?php foreach ($periode as $dp): ?>
                                      <?php if ($dk['id_periode'] != $dp['id_periode']): ?>
                                        <option value="<?= $dp['id_periode']; ?>"><?= $dp['periode']; ?></option>
                                      <?php endif ?>
                                    <?php endforeach ?>
                                  </select>
                                  <div class="invalid-feedback">
                                    <?= form_error('id_periode'); ?>
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
                      <a href="<?= base_url('kandidat/removeKandidat/' . $dk['id_kandidat']); ?>" class="btn btn-sm btn-danger m-1 btn-delete" data-nama="<?= $dk['nama']; ?> dengan NIM <?= $dk['nim']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
<div class="modal fade" id="addKandidatModal" tabindex="-1" aria-labelledby="addKandidatModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addKandidatModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Kandidat</h5>
 
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('kandidat'); ?>" class="close">
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
            <label for="visi" class="font-weight-normal">Visi</label>
            <textarea id="visi" class="form-control <?= (form_error('visi')) ? 'is-invalid' : ''; ?>" name="visi" required><?= set_value('visi'); ?></textarea>
            <div class="invalid-feedback">
              <?= form_error('visi'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="misi" class="font-weight-normal">Misi</label>
            <textarea id="misi" class="form-control <?= (form_error('misi')) ? 'is-invalid' : ''; ?>" name="misi" required><?= set_value('misi'); ?></textarea>
            <div class="invalid-feedback">
              <?= form_error('misi'); ?>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-4 text-center">
                <a href="<?= base_url('assets/img/img_candidates/default.png'); ?>" class="enlarge check_enlarge_photo">
                  <img class="img-fluid rounded check_photo" src="<?= base_url('assets/img/img_candidates/default.png'); ?>" alt="foto kandidat">
                </a>
                <small class="d-block">Klik foto untuk perbesar</small>
              </div>
              <div class="col-lg my-auto">
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input photo" id="foto_kandidat" name="foto_kandidat">
                    <label class="custom-file-label" for="foto_kandidat">Pilih File</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="no_urut" class="font-weight-normal">No. Urut</label>
            <input type="number" id="no_urut" class="form-control <?= (form_error('no_urut')) ? 'is-invalid' : ''; ?>" name="no_urut" required value="<?= set_value('no_urut'); ?>">
            <div class="invalid-feedback">
              <?= form_error('no_urut'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="id_periode" class="font-weight-normal">Periode</label>
            <select id="id_periode" class="custom-select <?= (form_error('id_periode')) ? 'is-invalid' : ''; ?>" name="id_periode" required>
              <?php if (set_value('id_periode') != null): ?>
                <?php 
                  $id_periode_old = set_value('id_periode');
                  $periode_old = $this->db->get_where('periode', ['id_periode' => $id_periode_old])->row_array();
                ?>
                <option value="<?= set_value('id_periode'); ?>"><?= $periode_old['periode']; ?></option>
              <?php endif ?>
              <?php foreach ($periode as $dp): ?>
                <?php if (set_value('id_periode') != null): ?>
                  <?php if ($id_periode_old != $dp['id_periode']): ?>
                    <option value="<?= $dp['id_periode']; ?>"><?= $dp['periode']; ?></option>
                  <?php endif ?>
                <?php else: ?>
                  <option value="<?= $dp['id_periode']; ?>"><?= $dp['periode']; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <div class="invalid-feedback">
              <?= form_error('id_periode'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('kandidat'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-times"></i> Tutup</a>
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
