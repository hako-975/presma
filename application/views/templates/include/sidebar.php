<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url('admin'); ?>" class="brand-link">
    <img src="<?= base_url('assets/img/img_properties/favicon.png'); ?>" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Presma</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <?php if (
            $_SERVER['REQUEST_URI'] == '/presma/admin/profile' || 
            $_SERVER['REQUEST_URI'] == '/presma/admin/profile/'
          ): ?>
            <a href="<?= base_url('admin/profile'); ?>" class="nav-link active"><i class="nav-icon fas fa-fw fa-user"></i> <p><?= $dataUser['username']; ?></p></a>
          <?php else: ?>
            <a href="<?= base_url('admin/profile'); ?>" class="nav-link"><i class="nav-icon fas fa-fw fa-user"></i> <p><?= $dataUser['username']; ?></p></a>
          <?php endif ?>
        </li>
        <li class="nav-item">
          <?php if (
            $_SERVER['REQUEST_URI'] == '/presma/admin' || 
            $_SERVER['REQUEST_URI'] == '/presma/admin/'
          ): ?>
            <a href="<?= base_url('admin'); ?>" class="nav-link active">
          <?php else: ?>
            <a href="<?= base_url('admin'); ?>" class="nav-link">
          <?php endif ?>
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dasbor
            </p>
          </a>
        </li>
        <?php if ($dataUser['role'] == 'Administrator'): ?>
          <li class="nav-item">
            <?php if (
              $_SERVER['REQUEST_URI'] == '/presma/role' || 
              $_SERVER['REQUEST_URI'] == '/presma/role/'
            ): ?>
              <a href="<?= base_url('role'); ?>" class="nav-link active">
                <i class="nav-icon fas fa-id-card-alt"></i>
                <p>
                  Jabatan
                </p>
              </a>
            <?php else: ?>
              <a href="<?= base_url('role'); ?>" class="nav-link">
                <i class="nav-icon fas fa-id-card-alt"></i>
                <p>
                  Jabatan
                </p>
              </a>
            <?php endif ?>
          </li>
          <li class="nav-item">
            <?php if (
              $_SERVER['REQUEST_URI'] == '/presma/user' || 
              $_SERVER['REQUEST_URI'] == '/presma/user/'
            ): ?>
              <a href="<?= base_url('user'); ?>" class="nav-link active">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Pengguna
                </p>
              </a>
            <?php else: ?>
              <a href="<?= base_url('user'); ?>" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Pengguna
                </p>
              </a>
            <?php endif ?>
          </li>
        <?php endif ?>
        <li class="nav-item">
          <?php if (
            $_SERVER['REQUEST_URI'] == '/presma/jurusan' || 
            $_SERVER['REQUEST_URI'] == '/presma/jurusan/'
          ): ?>
            <a href="<?= base_url('jurusan'); ?>" class="nav-link active">
              <i class="fas fa-user-graduate nav-icon"></i>
              <p>Jurusan</p>
            </a>
          <?php else: ?>
            <a href="<?= base_url('jurusan'); ?>" class="nav-link">
              <i class="fas fa-user-graduate nav-icon"></i>
              <p>Jurusan</p>
            </a>
          <?php endif ?>
        </li>
        <li class="nav-item">
          <?php if (
            $_SERVER['REQUEST_URI'] == '/presma/rombel' || 
            $_SERVER['REQUEST_URI'] == '/presma/rombel/'
          ): ?>
            <a href="<?= base_url('rombel'); ?>" class="nav-link active">
              <i class="fas fa-user-friends nav-icon"></i>
              <p>Rombel</p>
            </a>
          <?php else: ?>
            <a href="<?= base_url('rombel'); ?>" class="nav-link">
              <i class="fas fa-user-friends nav-icon"></i>
              <p>Rombel</p>
            </a>
          <?php endif ?>
        </li>
        <li class="nav-item">
          <?php if (
            $_SERVER['REQUEST_URI'] == '/presma/mahasiswa' || 
            $_SERVER['REQUEST_URI'] == '/presma/mahasiswa/'
          ): ?>
            <a href="<?= base_url('mahasiswa'); ?>" class="nav-link active">
              <i class="fas fa-users nav-icon"></i>
              <p>Mahasiswa</p>
            </a>
          <?php else: ?>
            <a href="<?= base_url('mahasiswa'); ?>" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>Mahasiswa</p>
            </a>
          <?php endif ?>
        </li>
        <li class="nav-item">
          <?php if (
            $_SERVER['REQUEST_URI'] == '/presma/periode' || 
            $_SERVER['REQUEST_URI'] == '/presma/periode/'
          ): ?>
            <a href="<?= base_url('periode'); ?>" class="nav-link active">
              <i class="fas fa-calendar nav-icon"></i>
              <p>Periode</p>
            </a>
          <?php else: ?>
            <a href="<?= base_url('periode'); ?>" class="nav-link">
              <i class="fas fa-calendar nav-icon"></i>
              <p>Periode</p>
            </a>
          <?php endif ?>
        </li>
        <li class="nav-item">
          <?php if (
            $_SERVER['REQUEST_URI'] == '/presma/kandidat' || 
            $_SERVER['REQUEST_URI'] == '/presma/kandidat/'
          ): ?>
            <a href="<?= base_url('kandidat'); ?>" class="nav-link active">
              <i class="fas fa-user-tie nav-icon"></i>
              <p>Kandidat <i class="right fas fa-angle-left"></i></p>
            </a>
          <?php else: ?>
            <a href="<?= base_url('kandidat'); ?>" class="nav-link">
              <i class="fas fa-user-tie nav-icon"></i>
              <p>Kandidat <i class="right fas fa-angle-left"></i></p>
            </a>
          <?php endif ?>
          <ul class="nav nav-treeview">
            <?php 
              $this->db->order_by('periode', 'asc');
              $periode = $this->db->get('periode')->result_array();
            ?>
            <?php foreach ($periode as $dp): ?>
              <li class="nav-item">
                <a href="<?= base_url('kandidat/periode/') . $dp['periode']; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= $dp['periode']; ?></p>
                </a>
              </li>
            <?php endforeach ?>
            <?php if ($dataUser['role'] != 'Tamu'): ?>
              <li class="nav-item">
                <a href="<?= base_url('periode/setFlashData/addPeriodeModal'); ?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Tambah Periode</p>
                </a>
              </li>
            <?php endif ?>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <?php if (
            $_SERVER['REQUEST_URI'] == '/presma/vote' || 
            $_SERVER['REQUEST_URI'] == '/presma/vote/'
          ): ?>
            <a href="<?= base_url('vote'); ?>" class="nav-link active">
              <i class="fas fa-vote-yea nav-icon"></i>
              <p>Vote <i class="right fas fa-angle-left"></i></p>
            </a>
          <?php else: ?>
            <a href="<?= base_url('vote'); ?>" class="nav-link">
              <i class="fas fa-vote-yea nav-icon"></i>
              <p>Vote <i class="right fas fa-angle-left"></i></p>
            </a>
          <?php endif ?>
          <ul class="nav nav-treeview">
            <?php 
              $this->db->order_by('periode', 'asc');
              $periode = $this->db->get('periode')->result_array();
            ?>
            <?php foreach ($periode as $dp): ?>
              <li class="nav-item">
                <a href="<?= base_url('vote/periode/') . $dp['periode']; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= $dp['periode']; ?></p>
                </a>
              </li>
            <?php endforeach ?>
            <?php if ($dataUser['role'] != 'Tamu'): ?>
              <li class="nav-item">
                <a href="<?= base_url('periode/setFlashData/addPeriodeModal'); ?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Tambah Periode</p>
                </a>
              </li>
            <?php endif ?>
          </ul>
        </li>
        <!-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-file nav-icon"></i>
            <p>Laporan</p>
          </a>
        </li> -->
        <div class="dropdown-divider"></div>
        <li class="nav-item">
          <a href="<?= base_url('log'); ?>" class="nav-link">
            <i class="fas fa-fw fa-history nav-icon"></i>
            <p>Riwayat</p>
          </a>
        </li>
        
        <!-- <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Starter Pages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Active Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inactive Page</p>
              </a>
            </li>
          </ul>
        </li> -->

        <!-- <div class="dropdown-divider"></div>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-stopwatch nav-icon"></i>
            <p>Riwayat Uang Kas</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-stopwatch nav-icon"></i>
            <p>Riwayat Pengeluaran</p>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>