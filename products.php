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

// --- ÜRÜN EKLE, GÜNCELLE, SİL ---
if (isset($_POST['add'])) {
    $prodObj->add($_POST['name'], $_POST['category_id'], $_POST['price']);
    set_flash('Ürün eklendi.');
}
if (isset($_POST['edit'])) {
    $prodObj->update($_POST['id'], $_POST['name'], $_POST['category_id'], $_POST['price']);
    set_flash('Ürün güncellendi.');
}
if (isset($_GET['delete'])) {
    $prodObj->delete($_GET['delete']);
    set_flash('Ürün silindi.');
}

$products = $prodObj->all();
$categories = $catObj->all();

$page = 'pages/products.view.php';
require 'layout.php';
?>