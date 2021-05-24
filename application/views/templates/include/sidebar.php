<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="assets/img/img_properties/favicon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Presma</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link"><i class="nav-icon fas fa-fw fa-user"></i> <p><?= $dataUser['username']; ?></p></a>
        </li>
        <li class="nav-item has-treeview menu-open">
          <a href="<?= base_url('admin'); ?>" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dasbor
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('role'); ?>" class="nav-link">
            <i class="nav-icon fas fa-id-card-alt"></i>
            <p>
              Jabatan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('user'); ?>" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Pengguna
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('jurusan'); ?>" class="nav-link">
            <i class="fas fa-user-graduate nav-icon"></i>
            <p>Jurusan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('rombel'); ?>" class="nav-link">
            <i class="fas fa-user-friends nav-icon"></i>
            <p>Rombel</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('periode'); ?>" class="nav-link">
            <i class="fas fa-calendar nav-icon"></i>
            <p>Periode</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-users nav-icon"></i>
            <p>Mahasiswa</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-user-tie nav-icon"></i>
            <p>Kandidat</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-vote-yea nav-icon"></i>
            <p>Vote</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-file nav-icon"></i>
            <p>Laporan</p>
          </a>
        </li>
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