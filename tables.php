<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/Table.php';
require_once __DIR__.'/includes/Order.php';
require_once __DIR__.'/includes/helpers.php';

require_login();
$db = (new Database())->getConnection();
$table = new Table($db);

// Filtre parametresini oku
$selected_group = isset($_GET['group']) ? $_GET['group'] : null;

// Masaları ilgili gruba göre çek
if ($selected_group === null) {
    $masalar = []; // Hiçbir masa gösterme
} elseif ($selected_group === 'Hepsi') {
    $masalar = $table->all();
} else {
    $masalar = $table->findByGroup($selected_group);
}

$page = 'pages/tables.view.php';
require 'layout.php';
?>