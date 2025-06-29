<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
body {
    background: linear-gradient(120deg,#f3f9fe 0%, #e6fff6 100%);
    min-height: 100vh;
}
.kullanici-card {
    border-radius: 1.2em;
    background: linear-gradient(135deg,#e8f6ff 0%,#f4fcf9 100%);
    box-shadow: 0 8px 32px 0 rgba(60,180,110,0.09), 0 2px 8px 0 rgba(0,0,0,0.03);
    margin-bottom: 2rem;
}
.kullanici-avatar {
    width:74px;
    height:74px;
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:50%;
    box-shadow:0 3px 10px rgba(0,0,0,0.09);
    border:3px solid #fff;
    margin-bottom: .5rem;
    font-size:2.7em;
}
.kullanici-role-badge {
    font-size:1em;
    box-shadow:0 2px 8px rgba(34,197,94,0.08);
    padding: 0.5em 1.2em;
    border-radius:2em;
}
.kullanici-form input,
.kullanici-form select {
    background:#eaf6fa;
    border-radius:.8em;
}
.kullanici-form input[type="text"] { width:90px; }
.kullanici-form input[type="password"] { width:100px; }
.kullanici-form select { width:100px; }
.kullanici-card .btn-warning { color: #fff; }
.kullanici-card .btn-warning:hover { background: #ffb300; color: #fff;}
.kullanici-card .btn-danger:hover { background: #d32f2f; color: #fff;}
.kullanici-card .btn:active { transform: scale(0.97);}
.kullanici-role-icon {
    position:absolute;
    bottom:5px;
    right:0;
    border-radius:50%;
    padding:6px 7px;
    box-shadow:0 2px 8px rgba(34,197,94,0.11);
    font-size:1.1em;
}
.kullanici-role-icon.admin { background:#22c55e; color:#fff;}
.kullanici-role-icon.personel { background:#60a5fa; color:#fff;}
@media (max-width: 991px) {
    .kullanici-card { border-radius: .8em; }
}
@media (max-width: 600px) {
    .kullanici-card { border-radius: .5em; }
}
</style>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-lg border-0" style="border-radius:1.3rem; background: #fafffd;">
                <div class="card-body px-4 py-4">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                        <h3 class="mb-0 fw-bold text-primary d-flex align-items-center gap-2">
                            <i class="bi bi-people"></i> Kullanıcılar
                        </h3>
                        <button class="btn btn-success btn-lg px-4" data-bs-toggle="modal" data-bs-target="#userAddModal" style="border-radius:1.2em;">
                            <i class="bi bi-person-plus"></i> Kullanıcı Ekle
                        </button>
                    </div>
                    <div class="row g-4">
                        <?php
                        $avatarColors = ['#3b82f6','#f59e42','#22c55e','#e11d48','#eab308','#8b5cf6','#0ea5e9'];
                        foreach($users as $u):
                            $bg = $avatarColors[$u['id']%count($avatarColors)];
                        ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card shadow-sm border-0 kullanici-card h-100">
                                    <div class="card-body d-flex flex-column align-items-center py-4">
                                        <div class="mb-2 position-relative">
                                            <div class="kullanici-avatar" style="background:<?= $bg ?>">
                                                <i class="bi bi-person-circle text-white"></i>
                                            </div>
                                            <?php if($u['role']=='admin'): ?>
                                                <span class="kullanici-role-icon admin">
                                                    <i class="bi bi-person-gear"></i>
                                                </span>
                                            <?php else: ?>
                                                <span class="kullanici-role-icon personel">
                                                    <i class="bi bi-person"></i>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($u['username']) ?></h5>
                                        <div class="mb-2">
                                            <span class="kullanici-role-badge"
                                                style="background:<?= $u['role']=='admin'
                                                    ? 'linear-gradient(90deg,#16c784 0%,#2cc9c6 100%)'
                                                    : 'linear-gradient(90deg,#60a5fa 0%,#a7ffeb 100%)' ?>;
                                                    color:<?= $u['role']=='admin' ? '#fff' : '#15517f' ?>;">
                                                <?= ucfirst($u['role']) ?>
                                            </span>
                                        </div>
                                        <form method="post" class="kullanici-form w-100 d-flex align-items-center gap-2 flex-wrap mb-2 justify-content-center">
                                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                            <input type="text" name="username" value="<?= htmlspecialchars($u['username']) ?>" required class="form-control form-control-sm">
                                            <input type="password" name="password" placeholder="Yeni Şifre" class="form-control form-control-sm">
                                            <select name="role" class="form-select form-select-sm">
                                                <option value="admin" <?= $u['role']=='admin' ? 'selected':'' ?>>Admin</option>
                                                <option value="personel" <?= $u['role']=='personel' ? 'selected':'' ?>>Personel</option>
                                            </select>
                                            <button name="edit" class="btn btn-sm btn-warning px-2" title="Güncelle"><i class="bi bi-pencil"></i></button>
                                        </form>
                                        <a href="?delete=<?= $u['id'] ?>" onclick="return confirm('Kullanıcı silinsin mi?')" class="btn btn-sm btn-danger px-3" style="border-radius:.8em;">
                                            <i class="bi bi-trash"></i> Sil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kullanıcı Ekle Modalı -->
    <div class="modal fade" id="userAddModal" tabindex="-1" aria-labelledby="userAddModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" class="modal-content">
          <div class="modal-header" style="background: linear-gradient(90deg,#43cea2 0%,#185a9d 100%);">
            <h5 class="modal-title fw-bold text-white" id="userAddModalLabel"><i class="bi bi-person-plus"></i> Kullanıcı Ekle</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body py-4">
            <div class="mb-3 text-center">
                <i class="bi bi-person-square" style="font-size:3em; color:#43cea2;"></i>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kullanıcı Adı</label>
                <input type="text" name="username" placeholder="Kullanıcı Adı" required class="form-control form-control-lg">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Şifre</label>
                <input type="password" name="password" placeholder="Şifre" required class="form-control form-control-lg">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Rol</label>
                <select name="role" class="form-select form-select-lg">
                    <option value="admin">Admin</option>
                    <option value="personel">Personel</option>
                </select>
            </div>
          </div>
          <div class="modal-footer">
            <button name="add" class="btn btn-success btn-lg px-4" style="border-radius:1.2em;">
                <i class="bi bi-person-plus"></i> Ekle
            </button>
          </div>
        </form>
      </div>
    </div>
</div>