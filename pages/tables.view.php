<?php
$grup_adi = $selected_group ?? '';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f4f8fb;
}
.table-section-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #0d6efd;
    margin-bottom: 1rem;
}
.table-card {
    border-radius: 18px;
    box-shadow: 0 5px 18px 0 rgba(60, 72, 88, 0.12);
    border: none;
    transition: transform .15s cubic-bezier(.4,0,.2,1), box-shadow .15s;
    cursor: pointer;
}
.table-card:hover {
    transform: translateY(-4px) scale(1.035);
    box-shadow: 0 12px 30px 0 rgba(60, 72, 88, 0.20);
}
.masa-title {
    font-weight: 600;
    font-size: 1.1rem;
}
.masa-badge {
    padding: 2px 10px;
    border-radius: 12px;
    font-size: .85rem;
    background: #e3e9f2;
    color: #333;
    margin-left: .25em;
}
.masa-badge.dolu {
    background: linear-gradient(90deg, #ff4a4a, #ffb199);
    color: white;
}
.masa-status-icon {
    font-size: 1.3em;
    margin-right: 3px;
}
.custom-btn {
    border: none;
    border-radius: 8px;
    padding: 6px 18px;
    font-size: .93rem;
    font-weight: 600;
    transition: background .13s;
}
.btn-siparis {
    background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
    color: #fff;
}
.btn-siparis:hover { background: linear-gradient(90deg, #2ecf5b, #21b6ad);}
.btn-odeme {
    background: linear-gradient(90deg, #f7971e 0%, #ffd200 100%);
    color: #fff;
}
.btn-odeme:hover { background: linear-gradient(90deg, #c97e10, #ffd700);}
.btn-odeme.disabled, .btn-odeme:disabled {
    background: #eee;
    color: #aaa;
    cursor: not-allowed;
}
@media (max-width: 576px) {
    .card.table-card { min-height: 140px; }
    .container { padding: 0 8px; }
    .btn-group .btn { font-size: 1rem; }
}
</style>
<div class="container py-3">
    <h2 class="fw-bold text-primary mb-2" style="letter-spacing:.03em;">Masalar</h2>
    <!-- Katagori Butonları -->
    <div class="btn-group mb-4 w-100" role="group" aria-label="Bölge Seçimi">
        <a href="tables.php?group=Hepsi" class="btn btn-outline-secondary<?= ($grup_adi == 'Hepsi') ? ' active' : '' ?>">Tümü</a>
        <a href="tables.php?group=İç Mekan" class="btn btn-outline-success<?= ($grup_adi == 'İç Mekan') ? ' active' : '' ?>">İç Mekan</a>
        <a href="tables.php?group=Dış Cephe" class="btn btn-outline-success<?= ($grup_adi == 'Dış Cephe') ? ' active' : '' ?>">Dış Cephe</a>
    </div>
    <?php if ($grup_adi === null || $grup_adi === ''): ?>
        <div class="alert alert-info">Lütfen bir masa grubu seçiniz.</div>
    <?php elseif (empty($masalar)): ?>
        <div class="alert alert-info">Seçilen bölgede masa bulunamadı.</div>
    <?php else: ?>
        <h4 class="table-section-title"><?= htmlspecialchars($grup_adi) ?></h4>
        <div class="row">
        <?php foreach($masalar as $t): ?>
            <?php
              $status = $t['status'];
              $badgeClass = ($status === 'Dolu') ? 'dolu' : '';
              $statusIcon = ($status === 'Dolu')
                ? '<span class="masa-status-icon" title="Dolu">🔴</span>'
                : '<span class="masa-status-icon" title="Boş">🟢</span>';
              $butonAktif = ($status === 'Dolu') ? '' : 'disabled';
            ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
              <div class="card table-card h-100" data-bs-toggle="modal" data-bs-target="#masaModal<?= $t['id'] ?>">
                <div class="card-body pb-2">
                  <div class="d-flex align-items-center mb-2" style="gap:.4em;">
                    <span class="masa-title"><?= $statusIcon ?><?= htmlspecialchars($t['name']) ?></span>
                    <span class="masa-badge <?= $badgeClass ?>"><?= htmlspecialchars($t['status']) ?></span>
                  </div>
                  <div class="mt-2" style="display: flex;gap:10px;">
                    <button type="button" class="custom-btn btn-siparis btn-sm" data-bs-toggle="modal" data-bs-target="#masaModal<?= $t['id'] ?>">
                      Detay
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="masaModal<?= $t['id'] ?>" tabindex="-1" aria-labelledby="masaModalLabel<?= $t['id'] ?>" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="masaModalLabel<?= $t['id'] ?>">
                      <?= $statusIcon ?> <?= htmlspecialchars($t['name']) ?> - <?= htmlspecialchars($t['status']) ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                  </div>
                  <div class="modal-body">
                    <!-- Dilersen burada masa ile ilgili daha fazla bilgi gösterebilirsin -->
                    <div class="d-flex flex-column gap-2">
                      <a href="order_add.php?table_id=<?= $t['id'] ?>" class="custom-btn btn-siparis btn-lg">
                        Sipariş Ver
                      </a>
                      <a href="order_complete.php?table_id=<?= $t['id'] ?>" class="custom-btn btn-odeme btn-lg <?= $butonAktif ?>">
                        Ödeme Al
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>