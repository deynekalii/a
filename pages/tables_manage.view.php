<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css">
<style>
    .masa-bg {
        background: linear-gradient(120deg,#e0ffe3 0%, #ccf2ff 100%);
        min-height: 82vh;
        margin: 0;
        padding-bottom: 40px;
    }
    .masa-card {
        border-radius: 2rem;
        background: rgba(255,255,255,0.97);
        box-shadow: 0 8px 32px 0 rgba(60,180,110,0.14), 0 2px 8px 0 rgba(0,0,0,0.03);
        margin-top: 2.5rem;
        margin-bottom: 2.5rem;
        animation: fadein 0.8s;
    }
    @keyframes fadein { from { opacity:0; transform: scale(0.98);} to {opacity:1; transform: scale(1);} }
    .masa-table th, .masa-table td {
        vertical-align: middle;
        font-size: 1.11em;
        transition: background .17s;
    }
    .masa-table thead th {
        background: linear-gradient(90deg,#11998e 0%,#38ef7d 100%);
        color: #fff;
        border: 0;
        font-weight: 600;
        letter-spacing: .03em;
    }
    .masa-table tbody tr {
        transition: box-shadow .17s, transform .12s;
        cursor: pointer;
    }
    .masa-table tbody tr:hover {
        box-shadow: 0 3px 18px 0 rgba(44,124,244,0.12);
        background: #e6f7ee;
        transform: scale(1.028);
        z-index: 2;
    }
    .masa-table input, .masa-table select {
        min-width: 110px;
        max-width: 180px;
        font-size: 1em;
    }
    .masa-badge {
        padding: 0.38em 1em;
        font-size: 1em;
        font-weight: 600;
        border-radius: 1.7em;
        box-shadow: 0 2px 10px 0 rgba(44,124,244,0.06);
        display: inline-flex;
        align-items: center;
        gap: .3em;
        animation: popin .5s;
    }
    .masa-badge.ic { background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%); color: #fff; }
    .masa-badge.dis { background: linear-gradient(90deg, #f7971e 0%, #ffd200 100%); color: #222; }
    @keyframes popin { from {transform:scale(0.92);} to {transform:scale(1);} }
    .btn-action {
        border-radius: .8em;
        min-width: 38px;
        font-size: 1.08em;
        transition: background .13s, transform .08s, box-shadow .18s;
        box-shadow: 0 1px 8px 0 rgba(60,180,110,.08);
    }
    .btn-action.btn-warning { color: #fff; }
    .btn-action.btn-warning:hover { background: #ffb300; color: #fff; transform: scale(1.07);}
    .btn-action.btn-danger { color: #fff; }
    .btn-action.btn-danger:hover { background: #d32f2f; color: #fff; transform: scale(1.07);}
    .btn-action i { pointer-events: none; }
    .btn-action:active { transform: scale(0.93);}
    .masa-ekle-card {
        border-radius: 1.3em;
        background: linear-gradient(135deg,#dbeafe 0%,#e0ffd6 100%);
        box-shadow: 0 2px 18px 0 rgba(34,197,94,.07);
        animation: fadein 0.7s;
    }
    .masa-ekle-card .card-header {
        border-radius: 1.3em 1.3em 0 0;
        background: transparent;
    }
    .masa-ikon-ic { color: #43cea2; filter: drop-shadow(0 1px 4px #1f66a1a8);}
    .masa-ikon-dis { color: #ffb300; filter: drop-shadow(0 1px 4px #ffd200a8);}
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 .15rem #11998e55;
        border-color: #11998e;
    }
    @media (max-width: 991px) {
        .masa-card { border-radius: 1.1rem; }
        .masa-table th, .masa-table td { font-size:1em; }
        .masa-ekle-card { border-radius: 0.7em; }
        .col-lg-8, .col-lg-4 { flex: 0 0 100%; max-width: 100%; }
    }
    @media (max-width: 600px) {
        .masa-card { border-radius: .5rem; }
        .masa-ekle-card { border-radius: .4em; }
    }
</style>
<div class="row justify-content-center masa-bg">
    <div class="col-12 col-lg-11">
        <div class="card shadow-lg border-0 masa-card">
            <div class="card-body px-4 py-4">
                <div class="row g-4">
                    <!-- MASA LİSTELERİ -->
                    <div class="col-12 col-lg-8">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="mb-0 fw-bold text-primary d-flex align-items-center gap-2">
                                <i class="bi bi-grid-3x3-gap-fill"></i> Masalar Yönetimi
                            </h3>
                        </div>
                        <!-- İç Mekan Masalar -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="masa-badge ic"><i class="bi bi-door-open masa-ikon-ic"></i> İç Mekan Masalar</span>
                                <span class="badge bg-light text-secondary fw-semibold"><?= count(array_filter($tables,fn($m)=>$m['group_name']=='İç Mekan')) ?> adet</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle shadow-sm masa-table" style="border-radius: 1.15em; overflow: hidden;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ad</th>
                                            <th>Bölüm</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($tables as $t): if($t['group_name']!=='İç Mekan') continue; ?>
                                        <tr>
                                            <form method="post" class="d-flex align-items-center gap-2 justify-content-between flex-wrap">
                                                <td>
                                                    <span class="badge bg-white border fw-bold text-secondary"><?= $t['id'] ?></span>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                                    <span class="me-2"><i class="bi bi-door-open masa-ikon-ic"></i></span>
                                                    <input type="text" name="name" value="<?= htmlspecialchars($t['name']) ?>" required class="form-control form-control-sm" style="border-radius:.8em; background:#edf6fa;">
                                                </td>
                                                <td>
                                                    <span class="masa-badge ic"><i class="bi bi-person-workspace masa-ikon-ic"></i> İç Mekan</span>
                                                </td>
                                                <td>
                                                    <button name="edit" class="btn btn-warning btn-action me-2" title="Güncelle">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <a href="?delete=<?= $t['id'] ?>" onclick="return confirm('Silinsin mi?')" class="btn btn-danger btn-action" title="Sil">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </form>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Dış Cephe Masalar -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="masa-badge dis"><i class="bi bi-tree masa-ikon-dis"></i> Dış Cephe Masalar</span>
                                <span class="badge bg-light text-secondary fw-semibold"><?= count(array_filter($tables,fn($m)=>$m['group_name']=='Dış Cephe')) ?> adet</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle shadow-sm masa-table" style="border-radius: 1.15em; overflow: hidden;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ad</th>
                                            <th>Bölüm</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($tables as $t): if($t['group_name']!=='Dış Cephe') continue; ?>
                                        <tr>
                                            <form method="post" class="d-flex align-items-center gap-2 justify-content-between flex-wrap">
                                                <td>
                                                    <span class="badge bg-white border fw-bold text-secondary"><?= $t['id'] ?></span>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                                    <span class="me-2"><i class="bi bi-tree masa-ikon-dis"></i></span>
                                                    <input type="text" name="name" value="<?= htmlspecialchars($t['name']) ?>" required class="form-control form-control-sm" style="border-radius:.8em; background:#edf6fa;">
                                                </td>
                                                <td>
                                                    <span class="masa-badge dis"><i class="bi bi-tree masa-ikon-dis"></i> Dış Cephe</span>
                                                </td>
                                                <td>
                                                    <button name="edit" class="btn btn-warning btn-action me-2" title="Güncelle">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <a href="?delete=<?= $t['id'] ?>" onclick="return confirm('Silinsin mi?')" class="btn btn-danger btn-action" title="Sil">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </form>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- MASA EKLE FORMU -->
                    <div class="col-12 col-lg-4">
                        <div class="card border-0 shadow-sm masa-ekle-card h-100">
                            <div class="card-header text-center">
                                <h4 class="fw-bold text-success mb-0 animate__animated animate__pulse animate__infinite">
                                    <i class="bi bi-plus-circle"></i> Masa Ekle
                                </h4>
                            </div>
                            <div class="card-body">
                                <form method="post" class="text-center" autocomplete="off">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold"><i class="bi bi-grid-3x3-gap"></i> Masa Adı</label>
                                        <input type="text" name="name" placeholder="Masa Adı" required class="form-control form-control-lg" style="border-radius:1em;">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold"><i class="bi bi-person-workspace"></i> Bölüm</label>
                                        <select name="group_name" class="form-select form-select-lg" style="border-radius:1em;">
                                            <option value="İç Mekan">İç Mekan</option>
                                            <option value="Dış Cephe">Dış Cephe</option>
                                        </select>
                                    </div>
                                    <button name="add" class="btn btn-success btn-lg px-4" style="border-radius:1.2em; transition:.2s;">
                                        <i class="bi bi-plus-lg"></i> Ekle
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /MASA EKLE FORMU -->
                </div>
            </div>
        </div>
    </div>
</div>