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
    }
    .card {
      margin-top: 50px;
      border: none;
      border-radius: 1.5rem;
      box-shadow: 0 6px 24px 0 rgba(0,0,0,.12);
      overflow: hidden;
      background: #fff;
    }
    .card-header {
      background: linear-gradient(90deg,#43cea2 0%,#185a9d 100%) !important;
      color: #fff !important;
      font-size: 1.15rem;
      font-weight: 700;
      border-bottom: none;
      letter-spacing: 1px;
    }
    .badge.bg-light.text-primary {
      font-size: 1rem;
      font-weight: 600;
      background: #f8f9fa !important;
      color: #185a9d !important;
    }
    .table {
      background: #f8f9fa;
      border-radius: 1rem;
      overflow: hidden;
      margin-bottom: 0;
    }
    .table thead th {
      background: #e3f6fc;
      border-bottom: 2px solid #a0d2eb;
      color: #185a9d;
      font-size: 1.07rem;
      font-weight: 700;
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
      font-size: 1.09rem;
      font-weight: 800;
      letter-spacing: 1px;
    }
    .butonlar-tek-satir {
      display: flex;
      gap: 8px;
      justify-content: center;
      margin-top: 20px;
      flex-wrap: wrap;
    }
    .butonlar-tek-satir .btn {
      min-width: 120px;
      font-size: 0.96rem;
      font-weight: 500;
      border-radius: 1.4rem;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0.36rem 0.4rem;
      letter-spacing: 0.02em;
      white-space: nowrap;
      transition: box-shadow .16s,transform .13s;
    }
    .butonlar-tek-satir .btn-success span { color: #25db61 !important; font-weight: 600; }
    .butonlar-tek-satir .btn-primary span { color: #0d6efd !important; font-weight: 600; }
    .butonlar-tek-satir .btn-warning span { color: #f7971e !important; font-weight: 600; }
    .butonlar-tek-satir .btn-secondary span { color: #fff !important; font-weight: 600; }
    .butonlar-tek-satir .btn i { margin-right: 6px; }
    .butonlar-tek-satir .btn:hover {
      box-shadow: 0 4px 16px 0 rgba(67,206,162,.18);
      transform: scale(1.04);
      opacity: .96;
    }
    @media (max-width: 600px) {
      .butonlar-tek-satir { flex-direction: column; gap: 7px; }
      .butonlar-tek-satir .btn { min-width: 100%; justify-content: flex-start; }
      .card { margin-top: 18px; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="col-lg-8 offset-lg-2">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div>
            <i class="bi bi-receipt"></i>
            Masa: <strong><?= htmlspecialchars($t['name']) ?></strong>
            <?php if ($openOrder): ?>
              <span class="badge bg-light text-primary ms-2">Açık Adisyon</span>
            <?php endif; ?>
          </div>
          <a href="tables.php" class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i> Masalara Dön</a>
        </div>
        <div class="card-body">
          <?php if ($order_items): ?>
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
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>