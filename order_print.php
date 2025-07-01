<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/Order.php';
require_once __DIR__.'/includes/Product.php';
require_once __DIR__.'/includes/Table.php';

$db = (new Database())->getConnection();
$orderObj = new Order($db);
$productObj = new Product($db);
$tableObj = new Table($db);

$order_id = $_GET['order_id'] ?? null;
if (!$order_id) {
    die("Adisyon bulunamadı.");
}

$order = $orderObj->getById($order_id);
if (!$order) {
    die("Sipariş bulunamadı.");
}

$table = $tableObj->get($order['table_id']);
$items = $orderObj->getItems($order_id);

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Adisyon Yazdır</title>
    <style>
        body {
            width: 58mm;
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            margin: 0;
            padding: 0;
        }
        .receipt {
            width: 58mm;
            padding: 5px 0 0 0;
        }
        .title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 15px;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            font-size: 11px;
            padding: 1px 0;
        }
        th {
            text-align: left;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 8px;
        }
        .aciklama {
            margin:7px 0 5px 0;
            font-weight:bold;
            font-size:12px;
            color:#d84315;
        }
        @media print {
            body { margin: 0; }
            button { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt">
        <div class="title">ADİSYON</div>
        <div>Masa: <?= htmlspecialchars($table['name'] ?? '-') ?></div>
        <div>Tarih: <?= date('d.m.Y H:i') ?></div>
        <div class="line"></div>
        <table>
            <thead>
                <tr>
                    <th>Ürün</th>
                    <th>Adet</th>
                    <th>Tutar</th>
                </tr>
            </thead>
            <tbody>
            <?php $total = 0; foreach($items as $item): 
                // Eğer ürün adı veya fiyatı yoksa, Product tablosundan çek
                if (!isset($item['name']) || !isset($item['price'])) {
                    $urun = $productObj->get($item['product_id']);
                    $item['name'] = $urun['name'] ?? '';
                    $item['price'] = $urun['price'] ?? 0;
                }
                $tutar = $item['qty'] * $item['price'];
                $total += $tutar;
            ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= $item['qty'] ?></td>
                <td style="text-align:right;"><?= number_format($tutar, 2) ?>₺</td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="line"></div>
        <?php if (!empty($order['note'])): ?>
            <div class="aciklama">
                AÇIKLAMA: <?= htmlspecialchars($order['note']) ?>
            </div>
        <?php endif; ?>
        <div class="total">TOPLAM: <?= number_format($total,2) ?> ₺</div>
    </div>
    <button onclick="window.print()">Tekrar Yazdır</button>
</body>
</html>