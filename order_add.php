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

if (
    // Eski form için: add_product submit butonu varsa
    isset($_POST['add_product'])
    // Yeni form için: product_id ve qty gönderildiyse
    || (isset($_POST['product_id']) && isset($_POST['qty']))
) {
    $product_id = $_POST['product_id'] ?? null;
    $qty = $_POST['qty'] ?? 1;

    // Güvenlik için integer'a çevir
    $product_id = intval($product_id);
    $qty = intval($qty);

    if ($product_id > 0 && $qty > 0) {
        $orderObj->addProduct($openOrder['id'], $product_id, $qty);
        $orderObj->setTableStatus($table_id, 'Dolu');
        // set_flash('Ürün eklendi.'); // Bu satırı KALDIRIN ya da yorum satırı yapın!
        // Ekledikten sonra tekrar aynı sayfaya yönlendir (F5 ile çift eklemeyi engeller)
        header("Location: ?table_id=" . urlencode($table_id));
        exit();
    }
}
if (isset($_GET['delete_item'])) {
    $orderObj->deleteItem($_GET['delete_item']);
    set_flash('Ürün çıkarıldı.');
    // Silmeden sonra da yönlendirme önerilir
    header("Location: ?table_id=" . urlencode($table_id));
    exit();
}

$order_items = $orderObj->getItems($openOrder['id']);
$t = $tableObj->get($table_id);
$page = 'pages/order_add.view.php';
require 'layout.php';
?>