<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col header-title">
        <h1 class="m-0 text-dark"><i class="fas fa-fw fa-tachometer-alt"></i> Dasbor</h1>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container">
    <div class="dropdown">
      <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Periode
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <?php foreach ($this->db->get('periode')->result_array() as $periode): ?>
        <?php if ($periode['aktif'] == 1): ?>
          <a class="dropdown-item" href="<?= base_url('admin/index/') . $periode['periode']; ?>"><?= $periode['periode']; ?> (Saat Ini)</a>
        <?php else: ?>
          <a class="dropdown-item" href="<?= base_url('admin/index/') . $periode['periode']; ?>"><?= $periode['periode']; ?></a>
        <?php endif ?>
        <?php endforeach ?>
      </div>
    </div>
    <?php if (isset($row_periode)): ?>
      <h3>Perolehan Suara Periode <?= $row_periode['periode']; ?></h3>
      <canvas id="myChart"></canvas>
    <?php endif ?>
  </div>
</section>
<!-- /.content -->
<script type="text/javascript">
  var ctx = document.getElementById("myChart");
  ctx.height = 100;
  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: [
        <?php
          foreach ($vote as $dv) {
            echo "'" .$dv['nama'] ."',";
          }
        ?>
      ],
      datasets: [{
          label: 'Perolehan Suara',
          backgroundColor: '#ADD8E6',
          borderColor: '##93C3D2',
          data: [
            <?php
              foreach ($vote as $dv) {
                $this->db->select('*, count(vote.id_mahasiswa) as perolehan_suara');
                $this->db->join('vote', 'vote.id_kandidat = kandidat.id_kandidat');
                $this->db->join('periode', 'periode.id_periode = vote.id_periode');
                $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = vote.id_mahasiswa');
                $perolehan_suara = $this->db->get_where('kandidat', ['kandidat.id_kandidat' => $dv['id_kandidat'], 'vote.id_periode' => $dv['id_periode']])->row_array();
                echo $perolehan_suara['perolehan_suara'] . ', ';
              }
            ?>
          ]
      }]
  },
  options: {
    scale: {
      ticks: {
        precision: 0
      }
    }
  }
});

</script>