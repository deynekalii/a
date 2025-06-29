<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/Product.php';
require_once __DIR__.'/includes/Category.php';
require_once __DIR__.'/includes/helpers.php';
require_login();

$tarih = $_GET['tarih'] ?? date('Y-m-d');
$baslangic = $_GET['baslangic'] ?? $tarih;
$bitis = $_GET['bitis'] ?? $tarih;
$masa_id = $_GET['masa_id'] ?? '';
$payment_type = $_GET['payment_type'] ?? '';
$show_adisyon_id = $_GET['show_adisyon_id'] ?? ''; // Detay için eklenen parametre

$db = (new Database())->getConnection();

// Adisyonlar
$where = ["o.status='Kapalı'", "DATE(o.closed_at) = ?"];
$params = [$tarih];
if ($masa_id) {
    $where[] = "o.table_id = ?";
    $params[] = $masa_id;
}
if ($payment_type) {
    $where[] = "o.payment_type = ?";
    $params[] = $payment_type;
}
$where_sql = count($where) ? ('WHERE ' . implode(' AND ', $where)) : '';

$sql = "
SELECT 
    o.id, 
    t.name as masa_adi, 
    o.closed_at, 
    o.payment_type, 
    u.username as kapatan_kisi,
    SUM(oi.qty * p.price) as toplam
FROM 
    orders o
    LEFT JOIN tables t ON o.table_id = t.id
    LEFT JOIN users u ON o.closed_by = u.id
    LEFT JOIN order_items oi ON oi.order_id = o.id
    LEFT JOIN products p ON oi.product_id = p.id
$where_sql
GROUP BY o.id
ORDER BY o.closed_at ASC
";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$adisyonlar = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Eğer detay isteniyorsa, ilgili adisyonun ürünlerini çek
$urunler = [];
if ($show_adisyon_id) {
    $sqlUrun = "
        SELECT 
            p.name as urun_adi,
            oi.qty as adet,
            p.price as birim_fiyat,
            (oi.qty * p.price) as toplam
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        WHERE oi.order_id = ?
    ";
    $stmtUrun = $db->prepare($sqlUrun);
    $stmtUrun->execute([$show_adisyon_id]);
    $urunler = $stmtUrun->fetchAll(PDO::FETCH_ASSOC);
}

$page = 'pages/rapor_detay.view.php';
require 'layout.php';
?>