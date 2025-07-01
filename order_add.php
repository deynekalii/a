<?php
require_once __DIR__.'/includes/config.php';
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

$table_id = $_GET['table_id'] ?? null;
if (!$table_id) {
    set_flash('Masa bulunamadı.', 'danger');
    header("Location: tables.php");
    exit();
}

// Kategorileri ve ürünleri çek
$categories = $productObj->getAllCategories();
$products = $productObj->all();

$openOrder = $orderObj->getOpenByTable($table_id);
if (!$openOrder) {
    $order_id = $orderObj->create($table_id);
    $openOrder = $orderObj->getOpenByTable($table_id);
}

// Açıklama kaydetme
if (isset($_POST['note_save'])) {
    $note = trim($_POST['adisyon_note'] ?? '');
    $orderObj->updateNote($openOrder['id'], $note);
    header("Location: ?table_id=" . urlencode($table_id));
    exit();
}

// Ürün EKLEME (SEPETE EKLE)
if (isset($_POST['add_product']) && isset($_POST['product_id']) && isset($_POST['qty'])) {
    $product_id = intval($_POST['product_id']);
    $qty = intval($_POST['qty']);
    if ($product_id > 0 && $qty > 0) {
        $orderObj->addProduct($openOrder['id'], $product_id, $qty);
        $orderObj->setTableStatus($table_id, 'Dolu');
        header("Location: ?table_id=" . urlencode($table_id));
        exit();
    }
}

// ÜRÜN ARTTIR/EKSİLT (adisyon satırında)
if (isset($_POST['cart_action'], $_POST['item_id'])) {
    $item_id = (int)$_POST['item_id'];
    if ($_POST['cart_action'] === 'increase') {
        $orderObj->changeQty($item_id, 1);
    } elseif ($_POST['cart_action'] === 'decrease') {
        $orderObj->changeQty($item_id, -1);
    }
    header("Location: ?table_id=" . urlencode($table_id));
    exit();
}

// Ürün silme
if (isset($_GET['delete_item'])) {
    $orderObj->deleteItem($_GET['delete_item']);
    set_flash('Ürün çıkarıldı.');
    header("Location: ?table_id=" . urlencode($table_id));
    exit();
}

$order_items = $orderObj->getItems($openOrder['id']);
$t = $tableObj->get($table_id);
$page = 'pages/order_add.view.php';
require 'layout.php';
?>