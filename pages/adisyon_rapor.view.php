<?php
$gunluk_adisyonlar = $gunluk_adisyonlar ?? [];
$masalar = $masalar ?? [];
$odeme_tipleri = $odeme_tipleri ?? [];
$baslangic = $baslangic ?? date('Y-m-d');
$bitis = $bitis ?? date('Y-m-d');
$masa_id = $masa_id ?? '';
$payment_type = $payment_type ?? '';

$genel_toplam = 0; $nakit_toplam = 0; $kart_toplam = 0;
foreach($gunluk_adisyonlar as $rapor) {
    $genel_toplam += $rapor['toplam_tutar'] ?: 0;
    $nakit_toplam += $rapor['nakit_tutar'] ?? 0;
    $kart_toplam += $rapor['kart_tutar'] ?? 0;
}
?>
<style>
    .report-card {
        border-radius: 1.1em;
        min-height: 130px;
        transition: box-shadow .2s, transform .1s;
        box-shadow: 0 6px 32px 0 rgba(20,120,80,0.07), 0 1.5px 9px 0 rgba(0,0,0,0.04);
        position: relative;
        overflow: hidden;
    }
    .report-card .icon-bg {
        position: absolute;
        right: 18px;
        top: 18px;
        opacity: 0.12;
        font-size: 4.5em;
    }
    .report-card .main-label {
        font-size: 1.08em;
        letter-spacing: 0.01em;
        font-weight: 600;
        color: #fff;
        text-shadow: 0 1px 10px rgba(0,0,0,0.13);
        margin-bottom: 4px;
    }
    .report-card .main-value {
        font-size: 2.2em;
        font-weight: 700;
        color: #fff;
        text-shadow: 0 2px 9px rgba(0,0,0,0.12);
        margin-bottom: 4px;
    }
    .report-card.nakit { background: linear-gradient(90deg,#ff5858 0%,#f09819 100%);}
    .report-card.kart { background: linear-gradient(90deg,#00c6ff 0%,#0072ff 100%);}
    .report-card.adisyon { background: linear-gradient(90deg,#43cea2 0%,#185a9d 100%);}
    .report-card:hover { box-shadow: 0 8px 40px 0 rgba(40,180,120,0.13); transform: scale(1.025);}
    .report-hero { font-size: 2.1em; font-weight: 800; color: #233987; }
    .filter-card { background: #f4f8ff; border-radius: 1.15em; box-shadow: 0 2px 16px 0 rgba(44,124,244,0.07);}
    .table thead th { font-weight: 650; font-size: 1rem;}
    .table tfoot th { font-weight: 700;}
    .table th, .table td { vertical-align: middle;}
    .badge-adisyon, .badge-nakit, .badge-kart, .badge-toplam {font-size:1.08em;}
    .badge-adisyon {background: #01d293; color: #fff;}
    .badge-nakit {background: #f09819; color: #fff;}
    .badge-kart {background: #0072ff; color: #fff;}
    .badge-toplam {background: #43cea2; color: #fff;}
    @media (max-width: 991px) {
        .report-card .main-value { font-size: 1.4em; }
        .report-hero { font-size: 1.2em; }
    }
</style>
<div class="container py-4">
    <div class="row mb-4 g-3">
        <div class="col-12 col-lg-4">
            <div class="report-card adisyon p-4 mb-2">
                <div class="icon-bg"><i class="bi bi-cash-stack"></i></div>
                <div class="main-label">Toplam Adisyon</div>
                <div class="main-value"><?= array_sum(array_column($gunluk_adisyonlar, 'toplam_adisyon')) ?></div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="report-card nakit p-4 mb-2">
                <div class="icon-bg"><i class="bi bi-currency-exchange"></i></div>
                <div class="main-label">Nakit Toplam</div>
                <div class="main-value"><?= number_format($nakit_toplam,2) ?> ₺</div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="report-card kart p-4 mb-2">
                <div class="icon-bg"><i class="bi bi-credit-card-2-front"></i></div>
                <div class="main-label">Kart Toplam</div>
                <div class="main-value"><?= number_format($kart_toplam,2) ?> ₺</div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-lg-12">
            <div class="filter-card p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-2">
                    <h2 class="fw-bold report-hero d-flex align-items-center gap-2 mb-0">
                        <i class="bi bi-receipt"></i> Günlük Adisyon Raporları
                    </h2>
                    <span class="badge rounded-pill bg-success fs-5 py-2 px-4 shadow-sm">
                        <?= count($gunluk_adisyonlar) ?> Gün Listeleniyor
                    </span>
                </div>
                <!-- Filtre Formu -->
                <form class="row g-3 align-items-end mb-3" method="get">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Başlangıç Tarihi</label>
                        <input type="date" name="baslangic" class="form-control" value="<?= htmlspecialchars($baslangic) ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Bitiş Tarihi</label>
                        <input type="date" name="bitis" class="form-control" value="<?= htmlspecialchars($bitis) ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Masa</label>
                        <select name="masa_id" class="form-select">
                            <option value="">Tümü</option>
                            <?php foreach($masalar as $masa): ?>
                                <option value="<?= $masa['id'] ?>" <?= ($masa_id==$masa['id'])?'selected':'' ?>>
                                    <?= htmlspecialchars($masa['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Ödeme Tipi</label>
                        <select name="payment_type" class="form-select">
                            <option value="">Tümü</option>
                            <?php foreach($odeme_tipleri as $tip): ?>
                                <option value="<?= htmlspecialchars($tip) ?>" <?= ($payment_type==$tip)?'selected':'' ?>>
                                    <?= htmlspecialchars($tip) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary w-100 fw-bold py-2" style="border-radius:1em;">
                            <i class="bi bi-funnel"></i>
                        </button>
                    </div>
                </form>
                <!-- /Filtre Formu -->
                <!-- Rapor Tablosu -->
                <div class="table-responsive mt-3">
                    <table class="table table-hover align-middle shadow-sm" style="background: #f7faff; border-radius: 1.15em; overflow: hidden;">
                        <thead style="background: linear-gradient(90deg,#2193b0 0%,#6dd5ed 100%); color: #fff;">
                            <tr>
                                <th><i class="bi bi-calendar-event"></i> Tarih</th>
                                <th><i class="bi bi-receipt-cutoff"></i> Toplam Adisyon</th>
                                <th><i class="bi bi-cash-stack"></i> Nakit</th>
                                <th><i class="bi bi-credit-card-2-front"></i> Kart</th>
                                <th><i class="bi bi-cash-coin"></i> Toplam Tutar</th>
                                <th>Detay</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($gunluk_adisyonlar as $rapor): ?>
                            <tr>
                                <td>
                                    <span class="fw-semibold text-primary"><?= htmlspecialchars($rapor['tarih']) ?></span>
                                </td>
                                <td>
                                    <span class="badge badge-adisyon"><?= $rapor['toplam_adisyon'] ?></span>
                                </td>
                                <td>
                                    <span class="badge badge-nakit"><?= number_format($rapor['nakit_tutar'] ?? 0,2) ?> ₺</span>
                                </td>
                                <td>
                                    <span class="badge badge-kart"><?= number_format($rapor['kart_tutar'] ?? 0,2) ?> ₺</span>
                                </td>
                                <td>
                                    <span class="badge badge-toplam"><?= number_format($rapor['toplam_tutar'] ?: 0,2) ?> ₺</span>
                                </td>
                                <td>
                                    <a href="rapor_detay.php?tarih=<?= urlencode($rapor['tarih']) ?>&baslangic=<?= htmlspecialchars($baslangic) ?>&bitis=<?= htmlspecialchars($bitis) ?>&masa_id=<?= htmlspecialchars($masa_id) ?>&payment_type=<?= htmlspecialchars($payment_type) ?>" class="btn btn-sm btn-outline-primary px-3" style="border-radius:.8em;">
                                        <i class="bi bi-search"></i> Detay
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($gunluk_adisyonlar)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Kriterlere uygun kayıt bulunamadı.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr style="background: #e7fbe7;">
                                <th colspan="2" class="text-end fs-5">GENEL TOPLAM:</th>
                                <th class="fs-5 text-danger"><?= number_format($nakit_toplam,2) ?> ₺</th>
                                <th class="fs-5 text-primary"><?= number_format($kart_toplam,2) ?> ₺</th>
                                <th class="fs-5 text-success"><?= number_format($genel_toplam,2) ?> ₺</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /Rapor Tablosu -->
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">