<!DOCTYPE html>
<html>
<head>
  <?php include 'include/js.php'; ?>
  <?php include 'include/css.php'; ?>
  <title><?= $title; ?></title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url(); ?>">
        <img src="<?= base_url('assets/img/img_properties/favicon-text.png'); ?>" class="d-inline-block align-top img-fluid img-w-200">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <div class="dropdown">
          <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Periode
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php foreach ($this->db->get('periode')->result_array() as $periode): ?>
            <?php if ($periode['aktif'] == 1): ?>
              <a class="dropdown-item" href="<?= base_url('landing/index/') . $periode['periode']; ?>"><?= $periode['periode']; ?> (Saat Ini)</a>
            <?php else: ?>
              <a class="dropdown-item" href="<?= base_url('landing/index/') . $periode['periode']; ?>"><?= $periode['periode']; ?></a>
            <?php endif ?>
            <?php endforeach ?>
          </div>
        </div>
        </div>
        <div class="navbar-nav ml-auto">
          <a class="nav-link" href="<?= base_url('admin'); ?>">Admin</a>
        </div>
      </div>
    </div>
  </nav>
          
        
