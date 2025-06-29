<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/Order.php';
require_once __DIR__.'/includes/Table.php'; // <-- Table ekle
require_once __DIR__.'/includes/helpers.php';
require_login();

$db = (new Database())->getConnection();
$orderObj = new Order($db);
$tableObj = new Table($db);

$table_id = $_GET['table_id'] ?? null;
if (!$table_id) {
    set_flash('Masa bulunamadı.', 'danger');
    header("Location: tables.php");
    exit();
}

$openOrder = $orderObj->getOpenByTable($table_id);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $openOrder) {
    $orderObj->complete($openOrder['id'], $_POST['odeme_tipi'], $_SESSION['user_id']);
    $orderObj->setTableStatus($table_id, 'Boş');
    set_flash('Adisyon kapatıldı.');
    header("Location: tables.php");
    exit();
}

$order_items = $orderObj->getItems($openOrder['id']);
$t = $tableObj->get($table_id); // <-- BUNU EKLE!
$page = 'pages/order_complete.view.php';
require 'layout.php';
?>