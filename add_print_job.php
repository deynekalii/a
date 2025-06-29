<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/db.php'; // Bu dosya Database sınıfını içeriyor
require_once __DIR__.'/includes/Order.php';
require_once __DIR__.'/includes/Product.php';
require_once __DIR__.'/includes/Table.php'; // Bu satıra burada ihtiyacınız yoksa kaldırabilirsiniz

// **EKLEMENİZ GEREKEN SATIR:**
$db = (new Database())->getConnection();

$order_id = $_POST['order_id'];

$db->query("INSERT INTO print_jobs (order_id, status, created_at) VALUES (?, 'waiting', NOW())", [$order_id]);
echo "OK";
?>