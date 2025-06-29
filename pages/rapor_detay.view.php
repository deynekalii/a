<?php
$tarih = $tarih ?? '';
$adisyonlar = $adisyonlar ?? [];
$urunler = $urunler ?? [];
$show_adisyon_id = $_GET['show_adisyon_id'] ?? null;

function odeme_tip_rengi($tip) {
    if (stripos($tip, 'nakit')!==false) return 'danger';
    if (stripos($tip, 'kart')!==false) return 'primary';
    return 'secondary';
}
function odeme_tip_ikon($tip) {
    if (stripos($tip, 'nakit')!==false) return 'bi-cash-coin';
    if (stripos($tip, 'kart')!==false) return 'bi-credit-card-2-front';
    return 'bi-wallet2';
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
body {
    background: linear-gradient(120deg,#f1fff6 0%, #e0f7ff 100%);
    min-height: 100vh;
    font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
}
.adisyon-detay-card {
    border-radius: 1.5rem;
    background: rgba(255,255,255,0.98);
    box-shadow: 0 8px 32px 0 rgba(50,140,83,.12), 0 2px 8px 0 rgba(0,0,0,0.03);
    margin-top: 2.5rem;
    animation: fadein 0.7s;
}
@keyframes fadein { from { opacity:0; transform: scale(0.98);} to {opacity:1; transform: scale(1);} }
.table thead th {
    background: linear-gradient(90deg,#3ebd6b 0%,#51ffb6 100%);
    color: #fff;
    border: 0;
    font-weight: 600;
    letter-spacing: .03em;
}
.table-bordered>:not(caption)>*>* {
    border-width: 1px 1px;
}
.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #f8ffff;
}
.badge.bg-light { color: #556; }
.badge.bg-info { color: #065b3e; }
.badge.bg-secondary { background: #e2e2ef; color: #222; }
.btn-outline-primary.active, .btn-outline-primary:active {
    background: linear-gradient(90deg,#51ffb6 0%,#3ebd6b 100%) !important;
    color: #fff !important;
    border: none !important;
}
.btn-outline-primary:hover {
    background: linear-gradient(90deg,#51ffb6 0%,#3ebd6b 100%);
    color: #fff;
    border: none;
}
.adisyon-detay-tablo {
    border-radius: 1.1rem;
    overflow: hidden;
}
@media (max-width: 991px) {
    .adisyon-detay-card { border-radius: 1rem; }
    .adisyon-detay-tablo { border-radius: .7rem; }
}
</style>
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-lg-10">
            <div class="card shadow-lg border-0 adisyon-detay-card">
                <div class="card-body px-4 py-4">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                        <h3 class="fw-bold text-success mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-journal-check"></i>
                            <?= htmlspecialchars($tarih) ?> için Adisyon Detayı
                        </h3>
                        <a href="adisyon_rapor.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Listeye Dön
                        </a>
                    </div>
                    <div class="table-responsive adisyon-detay-tablo mb-4">
                        <table class="table table-bordered align-middle shadow-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Adisyon ID</th>
                                    <th>Masa</th>
                                    <th>Kapanış Saati</th>
                                    <th>Kapat. Kullanıcı</th>
                                    <th>Ödeme Tipi</th>
                                    <th>Toplam (₺)</th>
                                    <th>Detay</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($adisyonlar as $adisyon): ?>
                                <tr>
                                    <td class="fw-bold"><?= htmlspecialchars($adisyon['id']) ?></td>
                                    <td>
                                        <span class="badge bg-info"><i class="bi bi-person-badge"></i> <?= htmlspecialchars($adisyon['masa_adi']) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark"><i class="bi bi-clock-history"></i> <?= htmlspecialchars($adisyon['closed_at']) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary"><i class="bi bi-person-circle"></i> <?= htmlspecialchars($adisyon['kapatan_kisi']) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= odeme_tip_rengi($adisyon['payment_type']) ?>">
                                            <i class="bi <?= odeme_tip_ikon($adisyon['payment_type']) ?>"></i>
                                            <?= htmlspecialchars($adisyon['payment_type']) ?>
                                        </span>
                                    </td>
                                    <td class="fw-bold text-success fs-5"><?= number_format($adisyon['toplam'], 2) ?></td>
                                    <td>
                                        <a href="?tarih=<?=urlencode($tarih)?>&show_adisyon_id=<?=$adisyon['id']?>"
                                           class="btn btn-sm btn-outline-primary<?= ($show_adisyon_id==$adisyon['id']) ? ' active' : '' ?>">
                                            <i class="bi bi-list-ul"></i> Detay
                                        </a>
                                    </td>
                                </tr>
                                <?php if($show_adisyon_id==$adisyon['id'] && !empty($urunler)): ?>
                                <tr>
                                    <td colspan="7" class="p-0">
                                        <div class="p-3">
                                            <strong class="mb-2 d-block text-secondary">
                                                <i class="bi bi-list-ul"></i> Ürünler:
                                            </strong>
                                            <table class="table table-striped table-hover align-middle mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Ürün Adı</th>
                                                        <th>Adet</th>
                                                        <th>Birim Fiyat (₺)</th>
                                                        <th>Toplam (₺)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($urunler as $urun): ?>
                                                    <tr>
                                                        <td><i class="bi bi-cup-hot text-warning"></i> <?= htmlspecialchars($urun['urun_adi']) ?></td>
                                                        <td><?= $urun['adet'] ?></td>
                                                        <td><?= number_format($urun['birim_fiyat'],2) ?></td>
                                                        <td><?= number_format($urun['toplam'],2) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>