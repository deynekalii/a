<?php
require_once __DIR__.'/includes/config.php';

// AJAX kontrolü
$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';

// AJAX'ta PHP hatalarını logla, çıktı karışmasın
if ($is_ajax) {
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    error_reporting(E_ALL);
    // Output buffer'ı sıfırla, header/whitespace sorunu engelle
    if (ob_get_level()) ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
}

// Oturum kontrolü
if ($is_ajax && !isset($_SESSION['user_data'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'SESSION_EXPIRED']);
    exit;
}

require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/Order.php';
require_once __DIR__.'/includes/Product.php';
require_once __DIR__.'/includes/Table.php';
require_once __DIR__.'/includes/helpers.php';
require_login();

$db = (new Database())->getConnection();
$orderObj = new Order($db);
$productObj = new Product($db);
$tableObj = new Table($db);

// table_id GET veya (AJAX ise) POST'tan alınabilir
$table_id = $_GET['table_id'] ?? null;
if ($is_ajax) {
    $table_id = $_POST['table_id'] ?? $_GET['table_id'] ?? $table_id;
}

// table_id kontrolü
if (!$table_id) {
    if ($is_ajax) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'TABLE_ID_MISSING']);
        exit;
    } else {
        set_flash('Masa bulunamadı.', 'danger');
        header("Location: tables.php");
        exit();
    }
}

// Masa & açık adisyonu al
$t = $tableObj->get($table_id);
$openOrder = $t ? $orderObj->getOpenByTable($table_id) : null;
if ($t && !$openOrder) {
    $orderObj->create($table_id);
    $openOrder = $orderObj->getOpenByTable($table_id);
}

// AJAX güvenlik bloğu: masa veya adisyon yoksa hata dön
if ($is_ajax && (!$openOrder || !$t)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Masa veya adisyon bulunamadı!']);
    exit;
}

// Sepet HTML'i üretici fonksiyon
function getCartHtml($orderObj, $openOrder, $t) {
    ob_start();
    $order_items = $orderObj->getItems($openOrder['id']);
    $total = 0;
    if($order_items && count($order_items) > 0): ?>
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
    <?php endif;
    return ob_get_clean();
}

// --- AJAX İŞLEMLERİ ---

$ajax_response_sent = false; // kontrol için

// Ürün ekle
if ($is_ajax && isset($_POST['add_product'], $_POST['product_id'], $_POST['qty'])) {
    $product_id = intval($_POST['product_id']);
    $qty = intval($_POST['qty']);
    if ($product_id > 0 && $qty > 0) {
        $add_success = $orderObj->addProduct($openOrder['id'], $product_id, $qty);
        if ($add_success) {
            $orderObj->setTableStatus($table_id, 'Dolu');
            $openOrder = $orderObj->getOpenByTable($table_id);
            echo json_encode([
                'status' => 'success',
                'cartHtml' => getCartHtml($orderObj, $openOrder, $t)
            ]);
            $ajax_response_sent = true;
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Ürün eklenirken veritabanı hatası oluştu.']);
            $ajax_response_sent = true;
        }
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Geçersiz ürün ID veya miktar.']);
        $ajax_response_sent = true;
    }
}

// Ürün arttır/azalt
if ($is_ajax && isset($_POST['cart_action'], $_POST['item_id'])) {
    $item_id = (int)$_POST['item_id'];
    $success = false;
    if ($_POST['cart_action'] === 'increase') {
        $success = $orderObj->changeQty($item_id, 1);
    } elseif ($_POST['cart_action'] === 'decrease') {
        $success = $orderObj->changeQty($item_id, -1);
    }
    if ($success) {
        $openOrder = $orderObj->getOpenByTable($table_id);
        echo json_encode([
            'status' => 'success',
            'cartHtml' => getCartHtml($orderObj, $openOrder, $t)
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Miktar güncellenirken bir sorun oluştu.']);
    }
    $ajax_response_sent = true;
}

// Ürün sil
if ($is_ajax && isset($_POST['delete_item'])) {
    $delete_success = $orderObj->deleteItem($_POST['delete_item']);
    if ($delete_success) {
        if (empty($orderObj->getItems($openOrder['id']))) {
            $orderObj->setTableStatus($table_id, 'Boş');
        }
        $openOrder = $orderObj->getOpenByTable($table_id);
        echo json_encode([
            'status' => 'success',
            'cartHtml' => getCartHtml($orderObj, $openOrder, $t)
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Ürün silinirken bir sorun oluştu.']);
    }
    $ajax_response_sent = true;
}

// Açıklama kaydet
if ($is_ajax && isset($_POST['note_save'])) {
    $note = trim($_POST['adisyon_note'] ?? '');
    $note_success = $orderObj->updateNote($openOrder['id'], $note);
    if ($note_success) {
        $openOrder = $orderObj->getOpenByTable($table_id);
        echo json_encode([
            'status' => 'success',
            'noteHtml' => nl2br(htmlspecialchars($note))
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Açıklama kaydedilirken bir sorun oluştu.']);
    }
    $ajax_response_sent = true;
}

// AJAX ise ve hiçbir response üretilmediyse, son güvenlik önlemi:
if ($is_ajax && !$ajax_response_sent) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Geçersiz veya eksik istek!']);
    exit;
}

// --- NORMAL SAYFA YÜKLEMESİ ---
if (!$is_ajax) {
    $categories = $productObj->getAllCategories();
    $products = $productObj->all();
    $order_items = $orderObj->getItems($openOrder['id']);
    $page = 'pages/order_add.view.php';
    require 'layout.php';
}
?>