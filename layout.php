<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DEYNEKLER PİDE</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Responsive ve özel stiller -->
    <link rel="stylesheet" href="responsive.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom mb-4">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= BASE_URL ?>">
      <i class="bi bi-shop-window"></i> DEYNEKLER PİDE
    </a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Menüyü Aç">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['SCRIPT_NAME']) == 'tables.php' ? ' active' : '' ?>" href="<?= BASE_URL ?>tables.php"><i class="bi bi-grid-1x2"></i> Masalar</a>
        </li>
        <?php if (is_admin()): ?>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['SCRIPT_NAME']) == 'products.php' ? ' active' : '' ?>" href="<?= BASE_URL ?>products.php"><i class="bi bi-box-seam"></i> Ürünler</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['SCRIPT_NAME']) == 'users.php' ? ' active' : '' ?>" href="<?= BASE_URL ?>users.php"><i class="bi bi-people"></i> Kullanıcılar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['SCRIPT_NAME']) == 'tables_manage.php' ? ' active' : '' ?>" href="<?= BASE_URL ?>tables_manage.php"><i class="bi bi-table"></i> Masalar Yönetimi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['SCRIPT_NAME']) == 'adisyon_rapor.php' ? ' active' : '' ?>" href="<?= BASE_URL ?>adisyon_rapor.php"><i class="bi bi-bar-chart"></i> Raporlar</a>
        </li>
        <?php endif; ?>
      </ul>
      <span class="navbar-text">
        <i class="bi bi-person-circle"></i>
        <?= $_SESSION['user_data']['username'] ?? '' ?>  
        <a href="<?= BASE_URL ?>logout.php" class="btn btn-logout btn-sm">Çıkış</a>
      </span>
    </div>
  </div>
</nav>

<div class="container">
  <div class="main-content-card">
    <?php
      if (function_exists('display_flash')) display_flash();
      if (isset($page)) require $page;
    ?>
  </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>