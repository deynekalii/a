<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Modern Adisyon Ekle</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    body { background: linear-gradient(120deg,#d4fc79 0%, #96e6a1 100%); min-height: 100vh; font-family: 'Segoe UI', Arial, sans-serif; }
    .modern-card { border-radius: 1.4rem; box-shadow: 0 6px 32px 0 rgba(0,0,0,.09); background: #fff; overflow: hidden; }
    .modern-card-header { background: linear-gradient(90deg,#27c993 0%,#1383b5 100%); color: #fff; font-size: 1.22rem; font-weight: 700; padding: 1rem 1.6rem; border-bottom: none; }
    .modern-badge { font-size: 1.06rem; font-weight: 600; background: #e3f6fc; color: #1976d2; border-radius: 1rem; padding: .45em 1.3em; }
    .modern-card-header .header-actions { display: flex; gap: 8px; }
    .modern-card-header .header-actions form, .modern-card-header .header-actions a { display: inline-block; margin: 0; }
    .modern-card-header .btn-warning { color: #664900; font-weight: 600; }
    .modern-card-header .btn-warning:hover { color: #332500; }
    .products-area-bg {
      background: #f4fbff;
      border-radius: 1.2rem;
      padding: 24px 18px 36px 18px;
      margin-bottom: 1.5rem;
      height: 520px;
      overflow-y: auto;
      min-height: unset;
      max-height: unset;
    }
    .category-scroll {
      overflow-x: auto;
      white-space: nowrap;
      margin-bottom: 1.2rem;
      padding-bottom: 2px;
    }
    .category-btn {
      display: inline-block;
      margin-right: 4px;
      margin-bottom: 0px;
      padding: 0.24em 0.85em;
      border-radius: 1.2em;
      background: #e3f6fc;
      color: #1976d2;
      border: none;
      font-weight: 600;
      font-size: 0.97em;
      cursor: pointer;
      transition: background .10s, color .10s;
      height: 28px;
      line-height: 1.0;
      min-width: 56px;
    }
    .category-btn.active, .category-btn:focus, .category-btn:hover {
      background: linear-gradient(90deg,#51ffb6 0%,#3ebd6b 100%);
      color: #085c3c;
    }
    .products-wrap { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:12px; }
    .product-btn {
      display: flex; flex-direction:column; align-items:center; justify-content:center;
      min-width: 95px; max-width:130px; padding:8px 5px 6px 5px; background: #6bc66b;
      color:#fff; border:none; border-radius:9px; font-size:0.99em; font-weight:500; cursor:pointer; box-shadow:0 1px 7px rgba(52,168,83,0.09); transition:background .13s;
    }
    .product-btn:hover { background: #39b548; color:#fff; }
    .product-price { font-weight:700; font-size:0.99em; margin-top:2px; }
    .cart-table thead th {
      background: #cbeafd;
      color: #1976d2;
      font-size: 0.98rem;
      font-weight: 500;
      font-family: 'Segoe UI', Arial, sans-serif;
      letter-spacing: 0.01em;
      padding: 6px 5px;
      border: none;
    }
    .cart-table tbody td, .cart-table tbody th {
      font-size: 0.96rem;
      font-weight: 400;
      color: #222b35;
      vertical-align: middle;
      padding: 6px 5px;
      font-family: 'Segoe UI', Arial, sans-serif;
      border: none;
    }
    .cart-table tbody td:first-child {
      font-weight: 500;
      font-size: 0.96rem;
      word-break: break-word;
      max-width: 115px;
    }
    .cart-table tfoot th {
      background: #1eaeec;
      color: #fff;
      font-size: 1.08rem;
      font-weight: 600;
      letter-spacing: .01em;
      border-bottom-left-radius: 10px;
      border-bottom-right-radius: 10px;
      border: none;
      padding: 8px 5px;
      text-align: right;
    }
    .cart-table {
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      overflow: hidden;
      margin-bottom: 0;
    }
    .cart-table .btn {
      padding: 2px 7px 2px 7px;
      font-size: 0.95em;
      border-radius: 7px;
    }
    .modern-card.cart-area {
      min-width:320px; max-width:540px;
      display: flex;
      flex-direction: column;
    }
    .modern-card.cart-area .card-body {
      flex: 1 1 auto;
      display: flex;
      flex-direction: column;
      padding: 0;
    }
    .modern-card.cart-area .table-responsive {
      flex: 1 1 auto;
      overflow-y: unset;
      min-height: unset;
      max-height: unset;
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
    .butonlar-tek-satir .btn i { margin-right: 6px; }
    .butonlar-tek-satir .btn:hover {
      box-shadow: 0 4px 16px 0 rgba(67,206,162,.18);
      transform: scale(1.04);
      opacity: .96;
    }
    @media (max-width: 991px) {
      .modern-page-flex { flex-direction: column; }
      .modern-card { margin-bottom: 1.5rem; }
      .products-wrap { gap:7px; }
      .products-area-bg { padding: 10px 3vw 20px 3vw; height: 380px; }
    }
    @media (max-width: 600px) {
      .butonlar-tek-satir { flex-direction: column; gap: 7px; }
      .butonlar-tek-satir .btn { min-width: 100%; justify-content: flex-start; }
      .modern-card { margin-top: 18px; }
      .modern-card-header .header-actions { flex-direction: column; gap: 6px;}
    }
  </style>
</head>
<body>
<div class="container py-4">

  <div class="modern-card mb-4">
    <div class="modern-card-header d-flex justify-content-between align-items-center">
      <span>
        <i class="bi bi-receipt me-2"></i> Adisyon — Masa: 
        <span class="modern-badge"><?= htmlspecialchars($t['name'] ?? '') ?></span>
      </span>
      <div class="header-actions">
        <a href="tables.php" class="modern-btn modern-btn-primary btn-sm me-2"><i class="bi bi-arrow-left"></i> Masalara Dön</a>
        <?php if (!empty($order_items)): ?>
        <button type="button" class="btn btn-warning btn-sm" onclick="addPrintJob(<?= htmlspecialchars($openOrder['id'] ?? 0) ?>)">
          <i class="bi bi-printer"></i> Yazdır
        </button>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="d-flex gap-4 modern-page-flex">

    <!-- Ürünler ve kategoriler RENKLİ ARKA PLAN -->
    <div class="flex-fill mb-0 products-area-bg">
      <!-- Kategoriler -->
      <div class="category-scroll" id="categoryScroll">
        <button class="category-btn active" onclick="showCategory(0)">Tümü</button>
        <?php foreach($categories as $cat): ?>
          <button class="category-btn" data-category="<?= $cat['id'] ?>" onclick="showCategory(<?= $cat['id'] ?>)"><?= htmlspecialchars($cat['name']) ?></button>
        <?php endforeach; ?>
      </div>
      <!-- Ürünler -->
      <?php
      $productsByCat = [];
      foreach($products as $p) {
        $productsByCat[$p['category_id']][] = $p;
      }
      ?>
      <div id="productsListWrap">
        <div class="products-wrap" data-category="0">
          <?php foreach($products as $p): ?>
            <form method="post" style="display:inline;">
              <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
              <input type="hidden" name="qty" value="1">
              <button type="submit" class="product-btn">
                <?= htmlspecialchars($p['name']) ?>
                <span class="product-price"><?= number_format($p['price'],2) ?>₺</span>
              </button>
            </form>
          <?php endforeach; ?>
        </div>
        <?php foreach($categories as $cat): ?>
          <div class="products-wrap d-none" data-category="<?= $cat['id'] ?>">
            <?php if(isset($productsByCat[$cat['id']])){
                foreach($productsByCat[$cat['id']] as $p): ?>
              <form method="post" style="display:inline;">
                <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                <input type="hidden" name="qty" value="1">
                <button type="submit" class="product-btn">
                  <?= htmlspecialchars($p['name']) ?>
                  <span class="product-price"><?= number_format($p['price'],2) ?>₺</span>
                </button>
              </form>
            <?php endforeach; } ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- /Ürünler ve kategoriler RENKLİ ARKA PLAN -->

    <!-- Sepet/güncel adisyon kartı -->
    <div class="modern-card cart-area flex-fill mb-0">
      <div class="card-body">
        <?php if(isset($order_items) && count($order_items) > 0): ?>
          <div class="table-responsive">
            <table class="table cart-table table-sm mb-0 align-middle">
              <thead>
                <tr>
                  <th>Ürün</th>
                  <th class="text-center">Adet</th>
                  <th class="text-end">Fiyat</th>
                  <th class="text-end">Toplam</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $total = 0; ?>
                <?php foreach($order_items as $item): ?>
                  <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td class="text-center"><?= $item['qty'] ?></td>
                    <td class="text-end"><?= number_format($item['price'], 2) ?>₺</td>
                    <td class="text-end"><?= number_format($item['qty'] * $item['price'], 2) ?>₺</td>
                    <td>
                      <a href="?table_id=<?= urlencode($t['id']) ?>&delete_item=<?= urlencode($item['id']) ?>" class="btn btn-outline-danger btn-sm"
                        title="Sil" onclick="return confirm('Bu ürünü adisyondan çıkarmak istiyor musunuz?')">
                        <i class="bi bi-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <?php $total += $item['qty'] * $item['price']; ?>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="3" class="text-end">Toplam:</th>
                  <th class="text-end"><?= number_format($total, 2) ?>₺</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </div>
        <?php else: ?>
          <div class="p-4 text-center text-muted fw-semibold" style="font-size:1.09rem;">Henüz ürün eklenmedi.</div>
        <?php endif; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function showCategory(catId) {
  document.querySelectorAll('.category-btn').forEach(btn => {
    btn.classList.toggle('active', (btn.getAttribute('data-category') == catId) || (catId == 0 && !btn.getAttribute('data-category')));
  });
  document.querySelectorAll('.products-wrap').forEach(div => {
    div.classList.toggle('d-none', (catId != 0 && div.getAttribute('data-category') != catId));
  });
}

function addPrintJob(orderId) {
  fetch('add_print_job.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'order_id=' + encodeURIComponent(orderId)
  })
  .then(r => r.text())
  .then(res => {
    if (res.trim() === "OK") {
      alert("Yazdırma işine eklendi. Çıktı yazıcıdan otomatik alınacak.");
    } else {
      alert("Yazdırma kuyruğuna eklenemedi. Hata: " + res);
    }
  })
  .catch(err => alert("Sunucuya erişilemedi: " + err));
}
</script>
</body>
</html>