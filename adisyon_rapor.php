<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/User.php';
require_once __DIR__.'/includes/helpers.php';
require_admin();

$db = (new Database())->getConnection();

// Tarih filtreleri
if (isset($_GET['baslangic']) || isset($_GET['bitis'])) {
    $baslangic = $_GET['baslangic'] ?? date('Y-m-d');
    $bitis = $_GET['bitis'] ?? date('Y-m-d');
} else {
    $baslangic = date('Y-m-d');
    $bitis = date('Y-m-d');
}
$masa_id = $_GET['masa_id'] ?? '';
$payment_type = $_GET['payment_type'] ?? '';

// Masalar
$masalar = $db->query("SELECT id, name FROM tables ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

// Ödeme tipleri
$odeme_tipleri = $db->query("SELECT DISTINCT payment_type FROM orders WHERE payment_type IS NOT NULL")->fetchAll(PDO::FETCH_COLUMN);

// WHERE dinamik
$where = ["o.status='Kapalı'", "o.closed_at IS NOT NULL", "DATE(o.closed_at) >= ?", "DATE(o.closed_at) <= ?"];
$params = [$baslangic, $bitis];
if ($masa_id) {
    $where[] = "o.table_id = ?";
    $params[] = $masa_id;
}
if ($payment_type) {
    $where[] = "o.payment_type = ?";
    $params[] = $payment_type;
}
$where_sql = count($where) ? ('WHERE ' . implode(' AND ', $where)) : '';

// Günlük adisyonlar: nakit/kart/diğer dağılımı ile
$sql = "
SELECT 
    DATE(o.closed_at) as tarih, 
    COUNT(DISTINCT o.id) as toplam_adisyon,
    SUM(oi.qty * p.price) as toplam_tutar,
    SUM(CASE WHEN LOWER(o.payment_type) LIKE '%nakit%' THEN oi.qty * p.price ELSE 0 END) as nakit_tutar,
    SUM(CASE WHEN LOWER(o.payment_type) LIKE '%kart%' THEN oi.qty * p.price ELSE 0 END) as kart_tutar
FROM 
    orders o
    LEFT JOIN order_items oi ON oi.order_id = o.id
    LEFT JOIN products p ON oi.product_id = p.id
$where_sql
GROUP BY DATE(o.closed_at)
ORDER BY tarih DESC
";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$gunluk_adisyonlar = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page = 'pages/adisyon_rapor.view.php';
require 'layout.php';
?>