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
        <h1 class="m-0 text-dark"><i class="fas fa-fw fa-vote-yea"></i> Vote</h1>
      </div>
      <div class="col header-button">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVoteModal"><i class="fas fa-fw fa-plus"></i> Tambah Vote</button>
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
                <th>Periode</th>
                <th>Tanggal Vote</th>
                <th>Mahasiswa</th>
                <th>Kandidat</th>
                <th>Vote</th>
                <th style="width: 12.5rem">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($vote as $dv): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $dv['periode']; ?></td>
                  <?php if ($dv['tgl_vote'] == 0): ?>
                    <td></td>
                  <?php else: ?>
                    <td><?= date("Y-m-d, H:i:s", $dv['tgl_vote']); ?></td>
                  <?php endif ?>
                  <td><?= $dv['nama_mahasiswa']; ?></td>
                  <td><?= $dv['nama_kandidat']; ?></td>
                  <td><?= ucwords($dv['vote']); ?></td>
                  <td class="text-center">
                    <button type="button" data-toggle="modal" data-target="#editVoteModal<?= $dv['id_vote']; ?>" class="btn btn-sm btn-success m-1"><i class="fas fa-fw fa-edit"></i> Ubah</button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="editVoteModal<?= $dv['id_vote']; ?>" tabindex="-1" aria-labelledby="editVoteModalLabel<?= $dv['id_vote']; ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <form method="post" action="<?= base_url('vote/editVote/' . $dv['id_vote']); ?>">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editVoteModalLabel<?= $dv['id_vote']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Vote</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="vote<?= $dv['id_vote']; ?>" class="font-weight-normal">Vote</label>
                                <input type="text" id="vote<?= $dv['id_vote']; ?>" class="form-control <?= (form_error('vote')) ? 'is-invalid' : ''; ?>" name="vote" required value="<?= (form_error('vote') ? set_value('vote') : $dv['vote']); ?>">
                                <div class="invalid-feedback">
                                  <?= form_error('vote'); ?>
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

                    <a href="<?= base_url('vote/removeVote/' . $dv['id_vote']); ?>" class="btn btn-sm btn-danger m-1 btn-delete" data-nama="vote <?= $dv['nama_mahasiswa']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
<!-- tabindex="-1" -->
<div class="modal fade" id="addVoteModal"  aria-labelledby="addVoteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addVoteModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Vote</h5>
 
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('vote'); ?>" class="close">
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
          <div class="form-group">
            <label for="id_rombel" class="font-weight-normal">Rombel</label>
            <select id="id_rombel" class="custom-select select2 basic-single <?= (form_error('id_rombel')) ? 'is-invalid' : ''; ?>" name="id_rombel" required>
              <option value="0">Pilih Rombel</option>
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
            <small class="text-primary"><a href="<?= base_url('rombel/setFlashData/addRombelModal'); ?>">Tidak ada rombel yang dicari? tambahkan!</a></small>
          </div>
          <div class="form-group" id="fg-mahasiswa">
            <label for="id_mahasiswa" class="font-weight-normal">Mahasiswa</label>
            <select id="id_mahasiswa" class="custom-select select2 basic-single" name="id_mahasiswa"></select>
            <div class="invalid-feedback">
              <?= form_error('id_mahasiswa'); ?>
            </div>
            <small class="text-primary"><a href="<?= base_url('mahasiswa/setFlashData/addMahasiswaModal'); ?>">Tidak ada mahasiswa yang dicari? tambahkan!</a></small>
          </div>
        </div>
        <div class="modal-footer">
          <?php if (isset($behavior)): ?>
            <a href="<?= base_url('vote'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-times"></i> Tutup</a>
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

<script type="text/javascript">
  $(document).ready(function()
  {
    var BASE_URL = "<?= base_url(); ?>";

    $("#fg-mahasiswa").hide();

    $('body').on("change", "#id_rombel", function() 
    {
      $('#id_mahasiswa')
      .find('option')
      .remove()
      .end();

      var id = $(this).val();
      var data = "id="+id+"&data=mahasiswa";
      $.ajax({
        type: 'POST',
        url: BASE_URL + 'vote/get_mahasiswa',
        data: data,
        success: function(hasil) {
          $("#id_mahasiswa").html(hasil);
          console.log(hasil);
          $("#fg-mahasiswa").show();
        }
      });
    });
  });
</script>
