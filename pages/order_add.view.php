<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Modern Adisyon Ekle</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    /* ... Stil kodlarınız aynı şekilde ... */
    body { background: linear-gradient(120deg,#d4fc79 0%, #96e6a1 100%); min-height: 100vh; font-family: 'Segoe UI', Arial, sans-serif; }
    .modern-card { border-radius: 1.4rem; box-shadow: 0 6px 32px 0 rgba(0,0,0,.09); background: #fff; overflow: hidden; }
    .modern-card-header { background: linear-gradient(90deg,#27c993 0%,#1383b5 100%); color: #fff; font-size: 1.22rem; font-weight: 700; padding: 1rem 1.6rem; border-bottom: none; }
    .modern-badge { font-size: 1.06rem; font-weight: 600; background: #e3f6fc; color: #1976d2; border-radius: 1rem; padding: .45em 1.3em; }
    .modern-card-header .header-actions { display: flex; gap: 8px; }
    .modern-card-header .header-actions form, .modern-card-header .header-actions a { display: inline-block; margin: 0; }
    .modern-card-header .btn-warning { color: #664900; font-weight: 600; }
    .modern-card-header .btn-warning:hover { color: #332500; }
    .modern-card-header .btn-note {
      color: #0d5c63;
      background: #e3f6fc;
      border: none;
      font-size: 1rem;
      padding: 0.25rem 0.7rem;
      border-radius: 1.2em;
      display: flex;
      align-items: center;
      gap: 0.35em;
      transition: background 0.12s, color 0.12s;
    }
    .modern-card-header .btn-note:hover, .modern-card-header .btn-note:focus {
      color: #fff;
      background: #1383b5;
    }
    .products-area-bg {
      background: #f4fbff;
      border-radius: 1.2rem;
      padding: 24px 18px 36px 18px;
      margin-bottom: 1.5rem;
      height: 660px;
      overflow-y: auto;
      flex: 2 1 0%;
      min-width: 0;
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
    .products-wrap {
      display: flex;
      flex-wrap: wrap;
      gap: 7px;
      margin-bottom: 12px;
      justify-content: flex-start;
    }
    .product-btn {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-width: 75px;
      max-width: 95px;
      min-height: 68px;
      max-height: 84px;
      padding: 6px 2px 6px 2px;
      background: #6bc66b;
      color: #fff;
      border: none;
      border-radius: 9px;
      font-size: 0.89em;
      font-weight: 500;
      cursor: pointer;
      box-shadow: 0 1px 7px rgba(52,168,83,0.09);
      transition: background .13s, color .13s, box-shadow .13s;
      line-height: 1.1;
      text-align: center;
    }
    .product-btn:hover { background: #39b548; color:#fff; }
    .product-price { font-weight:700; font-size:0.96em; margin-top:2px; }
    .product-icon { font-size: 1.15em; margin-bottom: 2px; }
    .modern-page-flex {
      display: flex;
      flex-direction: row;
      align-items: stretch;
      gap: 1.5rem;
    }
    .modern-card.cart-area {
      flex: 1 1 350px;
      min-width: 340px;
      max-width: 480px;
      margin-bottom: 0 !important;
      display: flex;
      flex-direction: column;
      min-height: 600px;
      background: #fff;
    }
    .modern-card.cart-area .card-body {
      flex: 1 1 auto;
      display: flex;
      flex-direction: column;
      padding: 0;
    }
    .modern-card.cart-area .table-responsive {
      flex: 1 1 auto;
      min-height: unset;
      max-height: 600px;
      overflow-y: auto;
      scrollbar-width: thin;
      scrollbar-color: #cbeafd #fff;
    }
    .modern-card.cart-area .table-responsive::-webkit-scrollbar {
      width: 8px;
    }
    .modern-card.cart-area .table-responsive::-webkit-scrollbar-thumb {
      background: #cbeafd;
      border-radius: 8px;
    }
    .modern-card.cart-area .table-responsive::-webkit-scrollbar-track {
      background: #fff;
      border-radius: 8px;
    }
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
      white-space: normal;
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
    .cart-table .btn.qty-btn {
      padding: 1px 5px 1px 5px;
      font-size: 0.83em;
      border-radius: 7px;
      min-width: 19px;
      min-height: 19px;
      line-height: 1;
    }
    .cart-table .qty-control {
      display: flex;
      align-items: center;
      gap: 3px;
      justify-content: center;
    }
    .cart-table .qty-control form { display: inline; }
    @media (max-width: 991px) {
      .modern-page-flex { flex-direction: column; }
      .products-area-bg { padding: 10px 2vw 20px 2vw; height: 480px; }
      .modern-card { margin-bottom: 1.5rem; }
      .modern-card.cart-area {
        min-width: 100%;
        max-width: 100%;
        min-height: 450px;
      }
      .modern-card.cart-area .table-responsive { max-height: 450px; }
    }
    @media (max-width: 600px) {
      .modern-card { margin-top: 18px; }
      .modern-card-header { padding: 0.7rem 0.6rem; font-size: 1.06rem; }
      .modern-card-header .header-actions { flex-direction: row; gap: 6px; }
      .modern-card-header-content {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 0.5rem !important;
      }
      .modern-card-header .header-actions { justify-content: flex-start; }
      .modern-card.cart-area .table-responsive { max-height: 350px;}
      .products-area-bg { height: 400px; }
      .cart-table .btn.qty-btn { min-width: 16px; min-height: 16px; font-size: 0.80em; }
      .modern-card.cart-area {
        min-width: 100%;
        max-width: 100%;
        min-height: 350px;
      }
    }
    .modern-card-header-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      width: 100%;
    }
  </style>
</head>
<body>
<div class="container py-4">

  <div class="modern-card mb-4">
    <div class="modern-card-header">
      <div class="modern-card-header-content">
        <span>
          <i class="bi bi-receipt me-2"></i> Adisyon — Masa: 
          <span class="modern-badge"><?= htmlspecialchars($t['name'] ?? '') ?></span>
        </span>
        <div class="header-actions">
          <a href="tables.php" class="modern-btn modern-btn-primary btn-sm me-2"><i class="bi bi-arrow-left"></i> Masalara Dön</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modern-page-flex">

    <div class="products-area-bg mb-0">
      <div class="category-scroll" id="categoryScroll">
        <?php foreach($categories as $cat): ?>
          <button class="category-btn" data-category="<?= $cat['id'] ?>" onclick="showCategory(<?= $cat['id'] ?>)"><?= htmlspecialchars($cat['name']) ?></button>
        <?php endforeach; ?>
      </div>
      <?php
      function product_icon($name) {
        $name = mb_strtolower($name, 'UTF-8');
        if (str_contains($name, 'ayran')) return '<i class="bi bi-droplet-half product-icon" style="color:#00bfae"></i>';
        if (str_contains($name, 'su')) return '<i class="bi bi-droplet product-icon" style="color:#2196f3"></i>';
        if (str_contains($name, 'çay')) return '<i class="bi bi-cup-hot product-icon" style="color:#ff9800"></i>';
        if (str_contains($name, 'lahmacun')) return '<i class="bi bi-emoji-heart-eyes product-icon" style="color:#f44336"></i>';
        if (str_contains($name, 'pide')) return '<i class="bi bi-egg-fried product-icon" style="color:#e67e22"></i>';
        if (str_contains($name, 'pizza')) return '<i class="bi bi-pie-chart product-icon" style="color:#ff7043"></i>';
        if (str_contains($name, 'tost')) return '<i class="bi bi-grid-1x2-fill product-icon" style="color:#cddc39"></i>';
        if (str_contains($name, 'tatlı')) return '<i class="bi bi-cupcake product-icon" style="color:#b388ff"></i>';
        if (str_contains($name, 'salata')) return '<i class="bi bi-emoji-smile product-icon" style="color:#43a047"></i>';
        if (str_contains($name, 'kebap')) return '<i class="bi bi-fire product-icon" style="color:#d84315"></i>';
        if (str_contains($name, 'gazoz')) return '<i class="bi bi-cup-straw product-icon" style="color:#00bcd4"></i>';
        if (str_contains($name, 'kola')) return '<i class="bi bi-cup-straw product-icon" style="color:#1976d2"></i>';
        return '<i class="bi bi-egg-fried product-icon" style="color:#bdbdbd"></i>';
      }
      $productsByCat = [];
      foreach($products as $p) {
        $productsByCat[$p['category_id']][] = $p;
      }
      ?>
      <div id="productsListWrap">
        <?php foreach($categories as $cat): ?>
          <div class="products-wrap<?= $cat === $categories[0] ? '' : ' d-none' ?>" data-category="<?= $cat['id'] ?>">
            <?php if(isset($productsByCat[$cat['id']])){
                foreach($productsByCat[$cat['id']] as $p): ?>
              <form method="post" style="display:inline;" class="add-product-form">
                <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                <input type="hidden" name="qty" value="1">
                <input type="hidden" name="table_id" value="<?= htmlspecialchars($t['id']) ?>">
                <input type="hidden" name="add_product" value="1">
                <button type="submit" class="product-btn">
                  <?= product_icon($p['name']) ?>
                  <?= htmlspecialchars($p['name']) ?>
                  <span class="product-price"><?= number_format($p['price'],2) ?>₺</span>
                </button>
              </form>
            <?php endforeach; } ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="modern-card cart-area mb-0">
      <div id="cart-content-area" class="card-body">
        <div id="cart-inner">
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
                    <td class="text-center">
                      <div class="qty-control">
                        <form method="post" style="display:inline;" class="cart-action-form">
                          <input type="hidden" name="table_id" value="<?= htmlspecialchars($t['id']) ?>">
                          <input type="hidden" name="cart_action" value="decrease">
                          <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                          <button type="submit" class="btn btn-outline-secondary btn-sm qty-btn" <?= $item['qty'] <= 1 ? 'disabled' : '' ?> title="Azalt">
                            <i class="bi bi-dash"></i>
                          </button>
                        </form>
                        <span><?= $item['qty'] ?></span>
                        <form method="post" style="display:inline;" class="cart-action-form">
                          <input type="hidden" name="table_id" value="<?= htmlspecialchars($t['id']) ?>">
                          <input type="hidden" name="cart_action" value="increase">
                          <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                          <button type="submit" class="btn btn-outline-secondary btn-sm qty-btn" title="Arttır">
                            <i class="bi bi-plus"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                    <td class="text-end"><?= number_format($item['price'], 2) ?>₺</td>
                    <td class="text-end"><?= number_format($item['qty'] * $item['price'], 2) ?>₺</td>
                    <td>
                      <form method="post" style="display:inline;" class="cart-delete-form">
                          <input type="hidden" name="table_id" value="<?= htmlspecialchars($t['id']) ?>">
                          <input type="hidden" name="delete_item" value="<?= urlencode($item['id']) ?>">
                          <button type="submit" class="btn btn-outline-danger btn-sm"
                            title="Sil" onclick="return confirm('Bu ürünü adisyondan çıkarmak istiyor musunuz?')">
                            <i class="bi bi-trash"></i>
                          </button>
                      </form>
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
        <?php if (!empty($openOrder['note'])): ?>
          <div class="alert alert-info mt-3 py-2 px-3" style="font-size: 1.03em;">
            <i class="bi bi-info-circle me-1"></i>
            <span><?= nl2br(htmlspecialchars($openOrder['note'])) ?></span>
          </div>
        <?php endif; ?>
        </div>
        <!-- Butonlar her zaman, cart-inner dışında, asla ajax ile değişmez -->
        <div class="d-flex flex-row gap-2 mt-3 justify-content-end">
          <button type="button" class="btn btn-warning btn-sm"
            onclick="addPrintJob(<?= htmlspecialchars($openOrder['id'] ?? 0) ?>)"
            <?php if (empty($order_items)): ?>disabled<?php endif; ?>>
            <i class="bi bi-printer"></i> Yazdır
          </button>
          <button type="button" class="btn-note btn-sm" title="Adisyon açıklaması ekle/düzenle" onclick="openOrderNoteModal()">
            <i class="bi bi-chat-left-text"></i>
            Açıklama
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="orderNoteModal" tabindex="-1" aria-labelledby="orderNoteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="post" id="orderNoteForm">
        <div class="modal-header">
          <h5 class="modal-title" id="orderNoteModalLabel">Adisyon Açıklaması</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
        </div>
        <div class="modal-body">
          <textarea class="form-control" name="adisyon_note" id="adisyonNoteInput" rows="3" maxlength="200" placeholder="Adisyon için not veya açıklama yazın..."><?= htmlspecialchars($openOrder['note'] ?? '') ?></textarea>
          <input type="hidden" name="table_id" value="<?= htmlspecialchars($t['id']) ?>">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
          <button type="submit" class="btn btn-success" name="note_save">Kaydet</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let activeCategoryId = <?php echo isset($categories[0]['id']) ? (int)$categories[0]['id'] : 0; ?>;

function showCategory(catId) {
  activeCategoryId = catId;
  document.querySelectorAll('.category-btn').forEach(btn => {
    btn.classList.toggle('active', btn.getAttribute('data-category') == catId);
  });
  document.querySelectorAll('.products-wrap').forEach(div => {
    div.classList.toggle('d-none', div.getAttribute('data-category') != catId);
  });
}

document.addEventListener('DOMContentLoaded', () => {
    showCategory(activeCategoryId);
});

document.querySelectorAll('.add-product-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch(window.location.href, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                if (response.status === 401) {
                    alert('Oturum süresi doldu. Lütfen tekrar giriş yapın.');
                    window.location.reload();
                    return Promise.reject('Session expired');
                }
                throw new Error('Network response was not ok.');
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                // Sadece tablo ve not içeren kısmı değiştiriyoruz, butonlar asla kaybolmaz!
                document.getElementById('cart-inner').innerHTML = data.cartHtml;
                showCategory(activeCategoryId);
            } else {
                alert('Ürün eklenirken bir hata oluştu: ' + (data.message || 'Bilinmeyen Hata'));
            }
        })
        .catch(error => {
            console.error('Hata:', error);
            alert('Ürün eklenirken bir ağ hatası oluştu.');
        });
    });
});

document.getElementById('cart-content-area').addEventListener('submit', function(e) {
    const form = e.target.closest('.cart-action-form, .cart-delete-form');
    if (form) {
        e.preventDefault();
        let confirmed = true;
        if (form.classList.contains('cart-delete-form')) {
            confirmed = confirm('Bu ürünü adisyondan çıkarmak istiyor musunuz?');
        }
        if (confirmed) {
            const formData = new FormData(form);
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 401) {
                        alert('Oturum süresi doldu. Lütfen tekrar giriş yapın.');
                        window.location.reload();
                        return Promise.reject('Session expired');
                    }
                    throw new Error('Network response was not ok.');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    // Sadece tablo ve not içeren kısmı değiştiriyoruz, butonlar asla kaybolmaz!
                    document.getElementById('cart-inner').innerHTML = data.cartHtml;
                    showCategory(activeCategoryId);
                } else {
                    alert('İşlem sırasında bir hata oluştu: ' + (data.message || 'Bilinmeyen Hata'));
                }
            })
            .catch(error => {
                console.error('Hata:', error);
                alert('İşlem sırasında bir ağ hatası oluştu.');
            });
        }
    }
});

document.getElementById('orderNoteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const formData = new FormData(form);
    formData.append('note_save', '1');
    fetch(window.location.href, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 401) {
                alert('Oturum süresi doldu. Lütfen tekrar giriş yapın.');
                window.location.reload();
                return Promise.reject('Session expired');
            }
            throw new Error('Network response was not ok.');
        }
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            var modalElement = document.getElementById('orderNoteModal');
            var modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) {
                modal.hide();
            }
            const noteDisplay = document.querySelector('.alert.alert-info span');
            if (noteDisplay) {
                noteDisplay.innerHTML = data.noteHtml;
            } else {
                const cartAreaBody = document.querySelector('.modern-card.cart-area .card-body');
                if (cartAreaBody) {
                    const newNoteDiv = document.createElement('div');
                    newNoteDiv.className = 'alert alert-info mt-3 py-2 px-3';
                    newNoteDiv.style.fontSize = '1.03em';
                    newNoteDiv.innerHTML = `<i class="bi bi-info-circle me-1"></i><span>${data.noteHtml}</span>`;
                    cartAreaBody.appendChild(newNoteDiv);
                }
            }
            alert('Açıklama kaydedildi!');
        } else {
            alert('Açıklama kaydedilirken bir hata oluştu: ' + (data.message || 'Bilinmeyen Hata'));
        }
    })
    .catch(error => {
        console.error('Hata:', error);
        alert('Açıklama kaydedilirken bir ağ hatası oluştu.');
    });
});

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

function openOrderNoteModal() {
  var modal = new bootstrap.Modal(document.getElementById('orderNoteModal'));
  modal.show();
}
</script>
</body>
</html>