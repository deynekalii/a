<?php
// --- KATEGORİ EKLEME, DÜZENLEME, SİLME İŞLEMLERİ ---
try {
    if (isset($_POST['add_category'])) {
        $catName = trim($_POST['cat_name']);
        if ($catName !== '') {
            $catObj->add($catName);
            set_flash('Kategori eklendi.','success');
            header("Location: products.php");
            exit;
        }
    }
    if (isset($_POST['edit_category'])) {
        $catObj->update($_POST['cat_id'], $_POST['cat_name']);
        set_flash('Kategori güncellendi.','success');
        header("Location: products.php");
        exit;
    }
    if (isset($_GET['delete_category'])) {
        $catObj->delete($_GET['delete_category']);
        set_flash('Kategori silindi.','success');
        header("Location: products.php");
        exit;
    }
} catch(Exception $e) {
    set_flash($e->getMessage(), 'danger');
    header("Location: products.php");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
body {
    font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
    background: linear-gradient(120deg,#b6f4ff 0%, #d1f8be 100%);
    min-height: 100vh;
}
.card {
    border-radius: 1.2rem;
}
@media (max-width: 991px) {
    .col-lg-8, .col-lg-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .card {
        border-radius: 0.7em !important;
    }
}
.table-responsive {
    overflow-x: auto;
}
.table {
    min-width: 450px;
    background: #f5fff7;
    border-radius: 1.2em;
    overflow: hidden;
}
</style>

<div class="container py-3">
    <?php display_flash(); ?>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <div class="row g-4">
                        <!-- ÜRÜNLER ALANI -->
                        <div class="col-12 col-lg-8">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0 fw-bold text-success"><i class="bi bi-box-seam me-2"></i>Ürünler</h3>
                                <div>
                                    <button class="btn btn-success btn-lg px-4" data-bs-toggle="modal" data-bs-target="#prodAddModal" style="border-radius:1.2em;">
                                        <i class="bi bi-plus-circle"></i> Ürün Ekle
                                    </button>
                                </div>
                            </div>
                            <form class="row g-2 mb-4 align-items-end" method="get">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control form-control-lg" style="border-radius:1em;" placeholder="Ürün adı ara..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                                </div>
                                <div class="col-md-4">
                                    <select name="catfilter" class="form-select form-select-lg" style="border-radius:1em;">
                                        <option value="">Tüm Kategoriler</option>
                                        <?php foreach($categories as $c): ?>
                                            <option value="<?= $c['id'] ?>" <?= (($_GET['catfilter'] ?? '') == $c['id'])?'selected':'' ?>><?= htmlspecialchars($c['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2 col-6">
                                    <button class="btn btn-outline-success w-100 btn-sm py-2" style="border-radius:1em;">
                                        <i class="bi bi-search"></i> Filtrele
                                    </button>
                                </div>
                                <div class="col-md-2 col-6">
                                    <a href="products.php" class="btn btn-outline-secondary w-100 btn-sm py-2" style="border-radius:1em;">
                                        Tümünü Göster
                                    </a>
                                </div>
                            </form>
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-hover align-middle shadow-sm">
                                    <thead style="background: linear-gradient(90deg,#51ffb6 0%,#3ebd6b 100%); color: #fff;">
                                        <tr>
                                            <th style="border:0;">ID</th>
                                            <th style="border:0;">Ad</th>
                                            <th style="border:0;">Kategori</th>
                                            <th class="text-end" style="border:0;">Fiyat</th>
                                            <th style="width:110px; border:0;">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $rowbg=0; foreach($products as $p): 
                                        if (!empty($_GET['search']) && stripos($p['name'], $_GET['search']) === false) continue;
                                        if (!empty($_GET['catfilter']) && $p['category_id'] != $_GET['catfilter']) continue;
                                        $rowbg++;
                                    ?>
                                        <tr style="background:<?= $rowbg%2==0 ? '#e5f9ea':'#f8fff8' ?>;">
                                            <td><?= $p['id'] ?></td>
                                            <td>
                                                <span class="fw-semibold <?= $p['status']=='pasif'?'text-muted':'' ?>">
                                                    <?= htmlspecialchars($p['name']) ?>
                                                </span>
                                                <?php if($p['status']=='pasif'): ?>
                                                    <span class="badge bg-secondary ms-2">Pasif</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><span class="badge" style="background: #d0f5fd; color:#2196f3; font-size:1em;"><?= htmlspecialchars($p['category_name']) ?></span></td>
                                            <td class="text-end fw-bold text-success"><?= number_format($p['price'], 2) ?> ₺</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning me-1" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editProductModal"
                                                    data-id="<?= $p['id'] ?>"
                                                    data-name="<?= htmlspecialchars($p['name']) ?>"
                                                    data-category="<?= $p['category_id'] ?>"
                                                    data-price="<?= $p['price'] ?>"
                                                    title="Düzenle"
                                                    style="border-radius:.9em;"
                                                >
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <?php if($p['status'] == 'aktif'): ?>
                                                    <a href="products.php?passive_product=<?= $p['id'] ?>" class="btn btn-sm btn-secondary" title="Pasif Yap" style="border-radius:.9em;" onclick="return confirm('Bu ürünü pasif yapmak istediğinize emin misiniz?');">
                                                        <i class="bi bi-eye-slash"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="products.php?active_product=<?= $p['id'] ?>" class="btn btn-sm btn-success" title="Aktif Yap" style="border-radius:.9em;" onclick="return confirm('Bu ürünü tekrar aktif yapmak istediğinize emin misiniz?');">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <span class="badge bg-secondary">Pasif</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- KATEGORİLER ALANI -->
                        <div class="col-12 col-lg-4">
                            <div class="card border-0 shadow-sm h-100" style="border-radius:1em; min-height: 300px;">
                                <div class="card-header bg-info text-white d-flex align-items-center justify-content-between" style="border-radius:1em 1em 0 0;">
                                    <span><i class="bi bi-bookmarks me-2"></i> Kategoriler</span>
                                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#catAddModal">
                                        <i class="bi bi-bookmark-plus"></i> Ekle
                                    </button>
                                </div>
                                <div class="card-body p-0">
                                    <div class="list-group list-group-flush">
                                        <?php foreach($categories as $c): ?>
                                            <div class="list-group-item d-flex align-items-center justify-content-between gap-2 flex-wrap" style="border:0;">
                                                <form method="post" class="d-flex align-items-center gap-2 flex-grow-1">
                                                    <input type="hidden" name="cat_id" value="<?= $c['id'] ?>">
                                                    <input type="text" name="cat_name" value="<?= htmlspecialchars($c['name']) ?>" required class="form-control form-control-sm" style="max-width:120px; border-radius: 8px;">
                                                    <button name="edit_category" class="btn btn-warning btn-sm" title="Güncelle" style="border-radius: 7px;"><i class="bi bi-pencil"></i></button>
                                                </form>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delCatModal<?= $c['id'] ?>" title="Sil" style="border-radius: 7px;">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                            <div class="modal fade" id="delCatModal<?= $c['id'] ?>" tabindex="-1" aria-labelledby="delCatModalLabel<?= $c['id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form method="get" class="modal-content">
                                                        <input type="hidden" name="delete_category" value="<?= $c['id'] ?>">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title" id="delCatModalLabel<?= $c['id'] ?>"><i class="bi bi-trash"></i> Kategori Sil</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><b><?= htmlspecialchars($c['name']) ?></b> adlı kategoriyi silmek istediğinize emin misiniz?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-danger"><i class="bi bi-trash"></i> Sil</button>
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /KATEGORİLER ALANI -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ürün Ekle Modalı -->
<div class="modal fade" id="prodAddModal" tabindex="-1" aria-labelledby="prodAddModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg,#a8ff78 0%,#78ffd6 100%);">
        <h5 class="modal-title fw-bold text-success" id="prodAddModalLabel"><i class="bi bi-plus-circle"></i> Yeni Ürün Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
            <label class="form-label">Ürün Adı</label>
            <input type="text" name="name" placeholder="Ürün Adı" required class="form-control form-control-lg">
        </div>
        <div class="mb-2">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-select form-select-lg" required>
                <?php foreach($categories as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Fiyat (₺)</label>
            <input type="number" step="0.01" min="0" name="price" placeholder="Fiyat" required class="form-control form-control-lg">
        </div>
      </div>
      <div class="modal-footer">
        <button name="add" class="btn btn-success btn-lg px-4" style="border-radius:1.2em;"><i class="bi bi-plus-circle"></i> Ekle</button>
      </div>
    </form>
  </div>
</div>

<!-- Kategori Ekle Modalı -->
<div class="modal fade" id="catAddModal" tabindex="-1" aria-labelledby="catAddModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg,#a7bfe8 0%,#6190e8 100%);">
        <h5 class="modal-title fw-bold text-primary" id="catAddModalLabel"><i class="bi bi-bookmark-plus"></i> Yeni Kategori Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
            <label class="form-label">Kategori Adı</label>
            <input type="text" name="cat_name" placeholder="Kategori Adı" required class="form-control form-control-lg">
        </div>
      </div>
      <div class="modal-footer">
        <button name="add_category" class="btn btn-info btn-lg px-4" style="border-radius:1.2em;">
            <i class="bi bi-bookmark-plus"></i> Ekle
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Ürün Düzenle Modalı -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" class="modal-content">
      <input type="hidden" name="id" id="editProductId">
      <div class="modal-header" style="background: linear-gradient(90deg,#fceabb 0%,#f8b500 100%);">
        <h5 class="modal-title fw-bold text-warning" id="editProductModalLabel"><i class="bi bi-pencil"></i> Ürünü Düzenle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
            <label class="form-label">Ürün Adı</label>
            <input type="text" name="name" id="editProductName" required class="form-control form-control-lg">
        </div>
        <div class="mb-2">
            <label class="form-label">Kategori</label>
            <select name="category_id" id="editProductCategory" class="form-select form-select-lg" required>
                <?php foreach($categories as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Fiyat (₺)</label>
            <input type="number" step="0.01" min="0" name="price" id="editProductPrice" required class="form-control form-control-lg">
        </div>
      </div>
      <div class="modal-footer">
        <button name="edit" class="btn btn-warning btn-lg px-4" style="border-radius:1.2em;"><i class="bi bi-pencil"></i> Kaydet</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var editModal = document.getElementById('editProductModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('editProductId').value = button.getAttribute('data-id');
        document.getElementById('editProductName').value = button.getAttribute('data-name');
        document.getElementById('editProductCategory').value = button.getAttribute('data-category');
        document.getElementById('editProductPrice').value = button.getAttribute('data-price');
    });
});
</script>