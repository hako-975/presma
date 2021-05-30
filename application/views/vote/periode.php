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
        <h1 class="m-0 text-dark"><i class="fas fa-fw fa-vote-yea"></i> Vote <?= $row_periode['periode']; ?></h1>
      </div>
      <?php if ($dataUser['role'] != 'Tamu'): ?>
        <div class="col header-button">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVoteModal"><i class="fas fa-fw fa-plus"></i> Tambah Vote</button>
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
                <?php if ($row_periode['status'] == 'sudah_selesai'): ?>
                <th>Tanggal Vote</th>
                <?php endif ?>
                <th>Rombel</th>
                <th>Mahasiswa</th>
                <?php if ($row_periode['status'] == 'sudah_selesai'): ?>
                  <th>Kandidat</th>
                <?php endif ?>
                <th>Vote</th>
                <?php if ($dataUser['role'] != 'Tamu'): ?>
                  <th style="width: 12.5rem">Aksi</th>
                <?php endif ?>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($vote_periode as $dv): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <?php if ($row_periode['status'] == 'sudah_selesai'): ?>
                    <?php if ($dv['tgl_vote'] == 0): ?>
                      <td></td>
                    <?php else: ?>
                      <td><?= date("Y-m-d, H:i:s", $dv['tgl_vote']); ?></td>
                    <?php endif ?>
                  <?php endif ?>
                  <td><?= $dv['jurusan']; ?>, semester <?= $dv['semester']; ?></td>
                  <td><?= $dv['nama_mahasiswa']; ?></td>
                  <?php if ($row_periode['status'] == 'sudah_selesai'): ?>
                    <td><?= $dv['nama_kandidat']; ?></td>
                  <?php endif ?>
                  <td>
                    <?php if ($dv['vote'] == 'belum'): ?>
                      <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times"></i> <?= ucwords($dv['vote']); ?></button>
                    <?php else: ?>
                      <button type="button" class="btn btn-sm btn-success"><i class="fas fa-fw fa-check"></i> <?= ucwords($dv['vote']); ?></button>
                    <?php endif ?>
                  </td>
                  <?php if ($dataUser['role'] != 'Tamu'): ?>
                    <td class="text-center">
                      <a href="<?= base_url('vote/removeVote/' . $dv['id_vote'] . '/' . $row_periode['periode']); ?>" class="btn btn-sm btn-danger m-1 btn-delete" data-nama="vote <?= $dv['nama_mahasiswa']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
<!-- tabindex="-1" -->
<div class="modal fade" id="addVoteModal"  aria-labelledby="addVoteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <input type="hidden" name="id_periode" value="<?= $row_periode['id_periode']; ?>">
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
            <label for="id_rombel" class="font-weight-normal">Rombel</label>
            <select id="id_rombel" class="custom-select select2 basic-single <?= (form_error('id_rombel')) ? 'is-invalid' : ''; ?>" name="id_rombel" required>
              <option value="0">Pilih Rombel</option>
              <?php if (set_value('id_rombel') != null): ?>
                <?php 
                  $id_rombel_old = set_value('id_rombel');
                  $this->db->join('jurusan', 'rombel.id_jurusan = jurusan.id_jurusan');
                  $rombel_old = $this->db->get_where('rombel', ['id_rombel' => $id_rombel_old])->row_array();
                ?>
                <?php if ($rombel_old): ?>
                  <option value="<?= set_value('id_rombel'); ?>"><?= $rombel_old['jurusan']; ?>, semester <?= $rombel_old['semester']; ?></option>
                <?php endif ?>
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

