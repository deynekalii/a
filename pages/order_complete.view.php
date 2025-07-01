<?php
// Bootstrap ve Bootstrap Icons HEAD'de olmalı:
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Adisyon</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    body {
      background: linear-gradient(120deg,#d4fc79 0%, #96e6a1 100%);
      min-height: 100vh;
      margin: 0;
      padding: 0;
    }
    .adisyon-main {
      max-width: 900px;
      margin: 32px auto;
      background: rgba(255,255,255,0.85);
      border-radius: 2rem;
      box-shadow: 0 6px 32px 0 rgba(0,0,0,.12);
      padding: 32px 16px 24px 16px;
      min-height: calc(100vh - 64px);
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: stretch;
    }
    .adisyon-header {
      background: linear-gradient(90deg,#43cea2 0%,#185a9d 100%);
      color: #fff;
      font-size: 1.3rem;
      font-weight: 700;
      border-radius: 1.5rem 1.5rem 0 0;
      padding: 1.1rem 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      margin-bottom: 18px;
    }
    .badge.bg-light.text-primary {
      font-size: 1rem;
      font-weight: 600;
      background: #f8f9fa !important;
      color: #185a9d !important;
      border-radius: 1rem;
      box-shadow: 0 2px 8px 0 rgba(67,206,162,.10);
      padding: 0.5em 1.2em;
    }
    .table-wrap {
      max-height: 400px;
      overflow-y: auto;
      border-radius: 1.1rem;
      box-shadow: 0 0 0 1px #e3f6fc;
      margin-bottom: 0.8rem;
      background: #f8f9fa;
      padding: 0.5rem 0.5rem 0 0.5rem;
    }
    .table {
      background: #f8f9fa;
      margin-bottom: 0;
      border-radius: 1.1rem;
      font-size: 1.15rem;
      min-width: 100%;
    }
    .table thead th {
      background: #e3f6fc;
      border-bottom: 2px solid #a0d2eb;
      color: #185a9d;
      font-size: 1.13rem;
      font-weight: 700;
      position: sticky;
      top: 0;
      z-index: 2;
    }
    .table-striped>tbody>tr:nth-of-type(odd)>* {
      background-color: #eefaf0;
    }
    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
      background-color: #dafbe1;
      transition: 0.2s background;
    }
    .table tfoot th {
      background: #29b6f6;
      color: #fff;
      border-top: none;
      font-size: 1.18rem;
      font-weight: 800;
      letter-spacing: 1px;
      position: sticky;
      bottom: 0;
      z-index: 2;
    }
    /* Custom Scrollbar */
    .table-wrap::-webkit-scrollbar {
      width: 8px;
      background: #e3f6fc;
      border-radius: 6px;
    }
    .table-wrap::-webkit-scrollbar-thumb {
      background: #43cea2;
      border-radius: 6px;
    }
    .butonlar-tek-satir {
      display: flex;
      gap: 16px;
      justify-content: center;
      margin-top: 30px;
      flex-wrap: wrap;
      width: 100%;
    }
    .butonlar-tek-satir .btn {
      min-width: 150px;
      font-size: 1.18rem;
      font-weight: 600;
      border-radius: 2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0.6rem 1.3rem;
      letter-spacing: 0.02em;
      white-space: nowrap;
      box-shadow: 0 2px 10px 0 rgba(67,206,162,.15);
      transition: box-shadow .18s,transform .15s, background .22s;
      border: none;
    }
    .butonlar-tek-satir .btn-success {
      background: linear-gradient(90deg,#43cea2 0%,#25db61 100%);
      color: #fff !important;
    }
    .butonlar-tek-satir .btn-success:hover {
      background: linear-gradient(90deg,#25db61 0%,#43cea2 100%);
      box-shadow: 0 4px 18px 0 rgba(67,206,162,.28);
      transform: scale(1.06);
    }
    .butonlar-tek-satir .btn-primary {
      background: linear-gradient(90deg,#185a9d 0%,#0d6efd 100%);
      color: #fff !important;
    }
    .butonlar-tek-satir .btn-primary:hover {
      background: linear-gradient(90deg,#0d6efd 0%,#185a9d 100%);
      box-shadow: 0 4px 18px 0 rgba(24,90,157,.24);
      transform: scale(1.06);
    }
    .butonlar-tek-satir .btn-warning {
      background: linear-gradient(90deg,#f7971e 0%,#ffe259 100%);
      color: #444 !important;
    }
    .butonlar-tek-satir .btn-warning:hover {
      background: linear-gradient(90deg,#ffe259 0%,#f7971e 100%);
      color: #222;
      box-shadow: 0 4px 18px 0 rgba(247,151,30,.18);
      transform: scale(1.06);
    }
    .butonlar-tek-satir .btn-secondary {
      background: linear-gradient(90deg,#616161 0%,#9bc5c3 100%);
      color: #fff !important;
    }
    .butonlar-tek-satir .btn-secondary:hover {
      background: linear-gradient(90deg,#9bc5c3 0%,#616161 100%);
      box-shadow: 0 4px 18px 0 rgba(155,197,195,.22);
      transform: scale(1.06);
    }
    .butonlar-tek-satir .btn i {
      margin-right: 10px;
      font-size: 1.4em;
      filter: drop-shadow(0 1px 2px #fff7);
    }
    @media (max-width: 1000px) {
      .adisyon-main { max-width: 99vw; min-width: 0; padding: 12px 2vw;}
      .table { min-width: 400px; }
    }
    @media (max-width: 700px) {
      .adisyon-header { font-size: 1.06rem; padding: 0.9rem 0.8rem;}
      .adisyon-main { padding: 4vw 2vw 2vw 2vw; min-height: unset; }
      .table { min-width: 300px; }
    }
    @media (max-width: 600px) {
      .butonlar-tek-satir { flex-direction: column; gap: 8px; }
      .butonlar-tek-satir .btn { min-width: 100%; justify-content: flex-start; }
      .adisyon-main { border-radius: 0; }
    }
  </style>
</head>
<body>
  <div class="adisyon-main">
    <div class="adisyon-header">
      <div>
        <i class="bi bi-receipt"></i>
        Masa: <strong><?= htmlspecialchars($t['name']) ?></strong>
        <?php if ($openOrder): ?>
          <span class="badge bg-light text-primary ms-2">Açık Adisyon</span>
        <?php endif; ?>
      </div>
      <a href="tables.php" class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i> Masalara Dön</a>
    </div>
    <div class="adisyon-body flex-grow-1 d-flex flex-column">
      <?php if ($order_items): ?>
        <div class="table-wrap flex-grow-1">
          <table class="table table-striped table-hover align-middle mb-4">
            <thead>
              <tr>
                <th>Ürün</th>
                <th class="text-center">Adet</th>
                <th class="text-end">Birim Fiyat</th>
                <th class="text-end">Tutar</th>
              </tr>
            </thead>
            <tbody>
              <?php $toplam = 0; foreach($order_items as $item): $tutar = $item['price']*$item['qty']; $toplam += $tutar; ?>
              <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td class="text-center"><?= $item['qty'] ?></td>
                <td class="text-end"><?= number_format($item['price'], 2) ?> ₺</td>
                <td class="text-end"><?= number_format($tutar, 2) ?> ₺</td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="3" class="text-end">Genel Toplam</th>
                <th class="text-end"><?= number_format($toplam, 2) ?> ₺</th>
              </tr>
            </tfoot>
          </table>
        </div>
      <?php else: ?>
        <div class="alert alert-warning">Bu adisyonda ürün yok.</div>
      <?php endif; ?>

      <!-- Kompakt Butonlar Tek Satır -->
      <div class="butonlar-tek-satir">
        <form method="post" class="d-inline">
          <button name="odeme_tipi" value="Nakit" class="btn btn-success">
            <i class="bi bi-cash"></i> <span>Nakit</span>
          </button>
        </form>
        <form method="post" class="d-inline">
          <button name="odeme_tipi" value="Kredi Kartı" class="btn btn-primary">
            <i class="bi bi-credit-card"></i> <span>Kart</span>
          </button>
        </form>
        <?php if ($order_items): ?>
        <form action="order_print.php" method="get" target="_blank" class="d-inline">
          <input type="hidden" name="order_id" value="<?= htmlspecialchars($openOrder['id']) ?>">
          <button type="submit" class="btn btn-warning">
            <i class="bi bi-printer"></i> <span>Yazdır</span>
          </button>
        </form>
        <?php endif; ?>
        <a href="tables.php" class="btn btn-secondary d-inline">
          <i class="bi bi-arrow-left"></i> <span>Geri</span>
        </a>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>