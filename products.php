<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/Product.php';
require_once __DIR__.'/includes/Category.php';
require_once __DIR__.'/includes/helpers.php';
require_login();

$db = (new Database())->getConnection();
$prodObj = new Product($db);
$catObj = new Category($db);

// ÜRÜN ADETİ ARTTIR/ AZALT
if (isset($_POST['cart_action'], $_POST['item_id'])) {
    $item_id = (int)$_POST['item_id'];
    if ($_POST['cart_action'] === 'increase') {
        $stmt = $db->prepare("UPDATE order_items SET qty = qty + 1 WHERE id = ?");
        $stmt->execute([$item_id]);
    } elseif ($_POST['cart_action'] === 'decrease') {
        // Adet 1'in altına inmesin!
        $stmt = $db->prepare("UPDATE order_items SET qty = GREATEST(qty - 1, 1) WHERE id = ?");
        $stmt->execute([$item_id]);
    }
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
}

// --- KATEGORİ EKLEME BLOĞU (EN ÜSTE EKLE) ---
if (isset($_POST['add_category'])) {
    $catName = trim($_POST['cat_name']);
    if ($catName !== '') {
        $catObj->add($catName); // EĞER Category.php'de add() varsa onu kullan, yoksa PDO ile ekle
        set_flash('Kategori eklendi.');
        header("Location: products.php");
        exit;
    }
}

// --- ÜRÜN EKLE, GÜNCELLE, PASİF YAP ---
if (isset($_POST['add'])) {
    $prodObj->add($_POST['name'], $_POST['category_id'], $_POST['price']);
    set_flash('Ürün eklendi.');
    header("Location: products.php");
    exit;
}
if (isset($_POST['edit'])) {
    $prodObj->update($_POST['id'], $_POST['name'], $_POST['category_id'], $_POST['price']);
    set_flash('Ürün güncellendi.');
    header("Location: products.php");
    exit;
}
// Ürünü pasif yap
if (isset($_GET['passive_product'])) {
    $prodObj->setPassive($_GET['passive_product']);
    set_flash('Ürün pasif yapıldı.');
    header("Location: products.php");
    exit;
}

// Ürünü aktif yap
if (isset($_GET['active_product'])) {
    $prodObj->setActive($_GET['active_product']);
    set_flash('Ürün aktif yapıldı.');
    header("Location: products.php");
    exit;
}

// SİLME KALDIRILDI, ARTIK PASİF YAPILIYOR
// if (isset($_GET['delete'])) {
//     $prodObj->delete($_GET['delete']);
//     set_flash('Ürün silindi.');
//     header("Location: products.php");
//     exit;
// }

$products = $prodObj->all();
$categories = $catObj->all();

$page = 'pages/products.view.php';
require 'layout.php';
?>