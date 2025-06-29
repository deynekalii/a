<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/Table.php';
require_once __DIR__.'/includes/helpers.php';
require_login();

$db = (new Database())->getConnection();
$tableObj = new Table($db);

if (isset($_POST['add'])) {
    $tableObj->add($_POST['name'], $_POST['group_name']);
    set_flash('Masa eklendi.');
    header("Location: tables_manage.php");
    exit();
}
if (isset($_POST['edit'])) {
    $tableObj->update($_POST['id'], $_POST['name'], $_POST['group_name']);
    set_flash('Masa güncellendi.');
    header("Location: tables_manage.php");
    exit();
}
if (isset($_GET['delete'])) {
    $tableObj->delete($_GET['delete']);
    set_flash('Masa silindi.');
    header("Location: tables_manage.php");
    exit();
}

$tables = $tableObj->all();
$page = 'pages/tables_manage.view.php';
require 'layout.php';
?>