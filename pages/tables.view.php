<?php
$grup_adi = $selected_group ?? '';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(120deg,#f4f8fb 0%,#fff6fb 100%);
}
.table-section-title {
    font-size: 1.18rem;
    font-weight: 700;
    color: #0d6efd;
    margin-bottom: 1rem;
    letter-spacing: .03em;
}
.table-card {
    border-radius: 1.1em;
    box-shadow: 0 2px 10px 0 rgba(60, 72, 88, 0.13);
    border: 2px solid #e3e9f2;
    transition: transform .12s, box-shadow .12s, border .12s;
    cursor: pointer;
    min-height: 82px;
    position: relative;
    overflow: visible;
    padding: 0.1em 0.1em 0.2em 0.1em;
}
.table-card:hover {
    transform: translateY(-3px) scale(1.035);
    box-shadow: 0 5px 16px 0 rgba(60, 72, 88, 0.17);
    border-color: #b8d3fb;
}
.table-card .icon-decoration {
    position: absolute;
    left: -9px;
    top: 10px;
    font-size: 1.75em;
    opacity: .15;
    pointer-events: none;
}
.masa-title {
    font-weight: 700;
    font-size: .95rem;
    color: #23395d;
    display: flex;
    align-items: center;
    gap: .30em;
    letter-spacing: .005em;
}
.masa-badge {
    padding: 2px 11px 2px 8px;
    border-radius: 11px;
    font-size: .77rem;
    background: #e3e9f2;
    color: #345;
    margin-left: .27em;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 3px;
    border: 1px solid #e3e9f2;
    box-shadow: 0 1px 6px 0 rgba(60, 72, 88, 0.06);
}
.masa-badge.dolu {
    background: linear-gradient(90deg, #ff5252 25%, #ffd9d9 100%);
    color: #fff;
    border-color: #ff5252;
}
.masa-badge.rezerv {
    background: linear-gradient(90deg, #ffeb3b 10%, #fff59d 90%);
    color: #bfa500;
    border-color: #fff59d;
}
.masa-badge.bos {
    background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
    color: #fff;
    border-color: #43e97b;
}
.masa-status-icon {
    font-size: 1.10em;
    margin-right: 2px;
    vertical-align: middle;
}
.card.table-card .bi-cup-hot { color: #efad43; }
.card.table-card .bi-chair { color: #0d6efd; }
.card.table-card .bi-people { color: #ff5252; }
.card.table-card .bi-calendar2-check { color: #bfa500; }
.card.table-card .bi-emoji-smile { color: #ffc107;}
.card.table-card .bi-egg-fried { color: #43e97b;}
.card.table-card .bi-cloud-sun { color: #3ebd6b;}
.card.table-card .bi-umbrella { color: #4b71f5;}
.card.table-card .bi-fire { color: #f54b4b;}
.card.table-card .bi-cup-straw { color: #009688;}
.custom-btn {
    border: none;
    border-radius: 8px;
    padding: 5px 12px;
    font-size: .89rem;
    font-weight: 600;
    transition: background .13s, box-shadow .13s;
    margin: 2px 0;
    display: flex;
    align-items: center;
    gap: .45em;
    box-shadow: 0 2px 10px 0 rgba(60, 72, 88, 0.07);
}
.btn-siparis {
    background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
    color: #fff;
}
.btn-siparis:hover { background: linear-gradient(90deg, #22c55e, #00b5ad);}
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
    .card.table-card { min-height: 54px; }
    .container { padding: 0 2px; }
    .btn-group .btn { font-size: .95rem; }
}
</style>
<div class="container py-3">
    <h2 class="fw-bold text-primary mb-2" style="letter-spacing:.03em;"><i class="bi bi-layout-wtf"></i> Masalar</h2>
    <!-- Katagori Butonları -->
    <div class="btn-group mb-4 w-100" role="group" aria-label="Bölge Seçimi">
        <a href="tables.php?group=Hepsi" class="btn btn-outline-secondary<?= ($grup_adi == 'Hepsi') ? ' active' : '' ?>"><i class="bi bi-grid-1x2"></i> Tümü</a>
        <a href="tables.php?group=İç Mekan" class="btn btn-outline-success<?= ($grup_adi == 'İç Mekan') ? ' active' : '' ?>"><i class="bi bi-door-closed"></i> İç Mekan</a>
        <a href="tables.php?group=Dış Cephe" class="btn btn-outline-success<?= ($grup_adi == 'Dış Cephe') ? ' active' : '' ?>"><i class="bi bi-tree"></i> Dış Cephe</a>
    </div>
    <?php if ($grup_adi === null || $grup_adi === ''): ?>
        <div class="alert alert-info">Lütfen bir masa grubu seçiniz.</div>
    <?php elseif (empty($masalar)): ?>
        <div class="alert alert-info">Seçilen bölgede masa bulunamadı.</div>
    <?php else: ?>
        <h4 class="table-section-title">
            <i class="bi bi-chair me-1"></i><?= htmlspecialchars($grup_adi) ?>
        </h4>
        <div class="row g-2">
        <?php foreach($masalar as $t): ?>
            <?php
              $status = $t['status'];
              $type = $t['type'] ?? '';
              // Renkli arka planlar:
              $cardBg = match(true) {
                  $status === 'Dolu' => "background: linear-gradient(135deg,#ff8a8a 0%,#ffd9d9 100%);",
                  $status === 'Rezerve' => "background: linear-gradient(135deg,#fff700 0%,#fff59d 100%);",
                  $status === 'Boş' && ($t['name'] ?? '') === 'Balkon' => "background: linear-gradient(135deg,#83eaf1 0%,#63a4ff 100%);",
                  $status === 'Boş' && ($t['name'] ?? '') === 'Şemsiye' => "background: linear-gradient(135deg,#a8edea 0%,#fed6e3 100%);",
                  $status === 'Boş' && ($t['name'] ?? '') === 'Fırın Yanı' => "background: linear-gradient(135deg,#ffecd2 0%,#fcb69f 100%);",
                  $status === 'Boş' && ($t['name'] ?? '') === 'Bar' => "background: linear-gradient(135deg,#f7ff00 0%,#db36a4 100%);",
                  $status === 'Boş' && ($t['name'] ?? '') === 'Çocuk' => "background: linear-gradient(135deg,#fcb69f 0%,#ffecd2 100%);",
                  $status === 'Boş' && ($t['name'] ?? '') === 'Yumurta' => "background: linear-gradient(135deg,#f5f7fa 0%,#c3cfe2 100%);",
                  $status === 'Boş' => "background: linear-gradient(135deg,#b7ffcf 0%,#38f9d7 100%);",
                  default => "background: linear-gradient(120deg, #fff 82%, #f4f8fb 100%);"
              };
              $decorationIcon = match(true) {
                  $status === 'Dolu' => '<i class="bi bi-people icon-decoration"></i>',
                  $status === 'Rezerve' => '<i class="bi bi-calendar2-check icon-decoration"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Balkon' => '<i class="bi bi-cloud-sun icon-decoration"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Şemsiye' => '<i class="bi bi-umbrella icon-decoration"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Fırın Yanı' => '<i class="bi bi-fire icon-decoration"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Bar' => '<i class="bi bi-cup-straw icon-decoration"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Çocuk' => '<i class="bi bi-emoji-smile icon-decoration"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Yumurta' => '<i class="bi bi-egg-fried icon-decoration"></i>',
                  default => '<i class="bi bi-chair icon-decoration"></i>',
              };
              $mainIcon = match(true) {
                  $status === 'Dolu' => '<i class="bi bi-people"></i>',
                  $status === 'Rezerve' => '<i class="bi bi-calendar2-week"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Balkon' => '<i class="bi bi-cloud-sun"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Şemsiye' => '<i class="bi bi-umbrella"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Fırın Yanı' => '<i class="bi bi-fire"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Bar' => '<i class="bi bi-cup-straw"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Çocuk' => '<i class="bi bi-emoji-smile"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Yumurta' => '<i class="bi bi-egg-fried"></i>',
                  default => '<i class="bi bi-chair"></i>',
              };
              $badgeClass = match(true) {
                  $status === 'Dolu' => 'dolu',
                  $status === 'Rezerve' => 'rezerv',
                  $status === 'Boş' => 'bos',
                  default => '',
              };
              $badgeLabel = match(true) {
                  $status === 'Rezerve' => 'Rezerve',
                  $status === 'Dolu' => 'Dolu',
                  $status === 'Boş' => 'Boş',
                  default => $status,
              };
              $badgeIcon = match(true) {
                  $status === 'Dolu' => '<i class="bi bi-person-fill"></i>',
                  $status === 'Rezerve' => '<i class="bi bi-calendar2-event"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Balkon' => '<i class="bi bi-cloud-sun"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Şemsiye' => '<i class="bi bi-umbrella"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Fırın Yanı' => '<i class="bi bi-fire"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Bar' => '<i class="bi bi-cup-straw"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Çocuk' => '<i class="bi bi-emoji-smile"></i>',
                  $status === 'Boş' && ($t['name'] ?? '') === 'Yumurta' => '<i class="bi bi-egg-fried"></i>',
                  $status === 'Boş' => '<i class="bi bi-cup-hot"></i>',
                  default => '',
              };
            ?>
            <div class="col-6 col-md-4 col-lg-3 mb-2">
              <div class="card table-card h-100 px-1 py-1" style="<?= $cardBg ?>">
                <?= $decorationIcon ?>
                <div class="card-body p-2 d-flex flex-column justify-content-between h-100">
                  <div>
                    <div class="d-flex align-items-center mb-1" style="gap:.27em;">
                      <?= $mainIcon ?>
                      <span class="masa-title"><?= htmlspecialchars($t['name']) ?></span>
                      <span class="masa-badge <?= $badgeClass ?>">
                        <?= $badgeIcon ?> <?= htmlspecialchars($badgeLabel) ?>
                      </span>
                    </div>
                  </div>
                  <div class="mt-1 text-end d-flex flex-wrap gap-1 justify-content-end">
                    <a href="order_add.php?table_id=<?= $t['id'] ?>" class="custom-btn btn-siparis btn-sm">
                      <i class="bi bi-basket"></i> Sipariş 
                    </a>
                    <?php if($status === 'Dolu'): ?>
                      <a href="order_complete.php?table_id=<?= $t['id'] ?>" class="custom-btn btn-odeme btn-sm">
                        <i class="bi bi-cash-coin"></i> Ödeme Al
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>