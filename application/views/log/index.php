<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col header-title">
        <h1 class="m-0 text-dark"><i class="fas fa-fw fa-user-graduate"></i> Log</h1>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row my-3">
      <div class="col-lg">
        <div class="table-responsive">
          <table class="table table-bordered" id="table_id">
            <thead class="thead-dark">
              <tr>
                <th>No.</th>
                <th>Isi Log</th>
                <th>Tanggal Log</th>
                <th>User</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($log as $dl): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $dl['isi_log']; ?></td>
                  <td><?= date('Y-m-d, H:i:s', $dl['tgl_log']); ?></td>
                  <td><?= $dl['username']; ?></td>
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
