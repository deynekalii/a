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
    <style>
        :root {
            --main-red: #c0392b;
            --main-red-dark: #96281B;
            --main-red-light: #ff4949;
            --main-red-gradient: linear-gradient(90deg, #ff4949 0%, #c0392b 100%);
            --main-red-gradient-rev: linear-gradient(90deg, #c0392b 0%, #ff4949 100%);
            --main-bg: #fff0f0;
            --navbar-bg: #c0392b;
            --navbar-bg-gradient: linear-gradient(90deg, #ff4949 0%, #c0392b 100%);
            --navbar-link: #fff;
            --navbar-link-active: #ffd6d6;
            --navbar-link-hover: #ffb3b3;
            --navbar-shadow: 0 4px 18px 0 rgba(192,57,43,0.09);
        }
        body {
            background: var(--main-bg);
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
        }
        .navbar-custom {
            background: var(--navbar-bg-gradient);
            box-shadow: var(--navbar-shadow);
            border-bottom: 2px solid #ffb3b3;
        }
        .navbar-brand {
            color: #fff !important;
            font-weight: 800;
            letter-spacing: .02em;
            font-size: 1.38rem;
            text-shadow: 0 2px 10px rgba(192,57,43,0.11);
        }
        .navbar-brand i {
            font-size: 1.5rem;
            color: #fff;
            text-shadow: 0 1px 10px rgba(255,73,73,0.11);
        }
        .navbar-nav .nav-link {
            color: var(--navbar-link);
            font-weight: 500;
            letter-spacing: .01em;
            transition: color .15s;
            padding: .55em 1.2em .55em 1em;
            border-radius: 1em;
            font-size: 1.07em;
            margin: 0 .13em;
            display: flex;
            align-items: center;
            gap: 0.5em;
        }
        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:focus {
            background: rgba(255,255,255,0.13);
            color: var(--navbar-link-active) !important;
            font-weight: 700;
        }
        .navbar-nav .nav-link:hover {
            color: var(--navbar-link-hover);
            background: rgba(255,255,255,0.10);
        }
        .navbar-toggler {
            border-color: #fff;
            background: #96281B;
        }
        .navbar-toggler:focus {
            box-shadow: 0 0 0 .2rem #ffb3b3;
        }
        .navbar-text {
            color: #fff;
            font-weight: 500;
            font-size: 1.08em;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .navbar-text i {
            font-size: 1.2em;
            color: #ffd6d6;
        }
        .btn-logout {
            background: var(--main-red-light);
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 4px 16px;
            border-radius: 1.2em;
            margin-left: 7px;
            font-size: 0.99em;
            transition: background .15s, color .13s;
        }
        .btn-logout:hover {
            background: #fff;
            color: var(--main-red-dark);
            border: 1px solid var(--main-red-dark);
        }
        .main-content-card {
            background: #fff;
            border-radius: 1.4em;
            box-shadow: 0 8px 30px 0 rgba(192,57,43,0.08);
            padding: 2.5rem 1.3rem 1.5rem 1.3rem;
            margin-top: 24px;
            margin-bottom: 34px;
            min-height: 420px;
        }
        /* Responsive */
        @media (max-width: 991px) {
            .main-content-card {
                padding: 1.2rem .4rem 1.2rem .4rem;
                margin-top: 18px;
            }
            .navbar-nav .nav-link { font-size: 1em; padding: .5em 1em .5em 0.9em; }
        }
        @media (max-width: 600px) {
            .main-content-card { margin-top: 12px; }
            .navbar-brand { font-size: 1.09rem; }
            .navbar-text { font-size: 1em; }
        }
        /* Flash message style (isteğe bağlı) */
        .alert-flash {
            background: var(--main-red-gradient);
            color: #fff;
            font-weight: 500;
            border-radius: .8em;
            padding: .8em 1.5em;
            margin-bottom: 1.2em;
            box-shadow: 0 2px 9px 0 rgba(255,73,73,0.09);
            border: none;
            letter-spacing: .01em;
        }
    </style>
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