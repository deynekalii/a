<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/User.php';
require_once __DIR__.'/includes/helpers.php';
require_login();
if ($_SESSION['user_data']['role'] !== 'admin') {
    set_flash('Yetkiniz yok.', 'danger');
    header("Location: dashboard.php");
    exit();
}
$db = (new Database())->getConnection();
$userObj = new User($db);

if (isset($_POST['add'])) {
    $userObj->add($_POST['username'], $_POST['password'], $_POST['role']);
    set_flash('Kullanıcı eklendi.');
}
if (isset($_POST['edit'])) {
    $userObj->update($_POST['id'], $_POST['username'], $_POST['password'], $_POST['role']);
    set_flash('Kullanıcı güncellendi.');
}
if (isset($_GET['delete'])) {
    $userObj->delete($_GET['delete']);
    set_flash('Kullanıcı silindi.');
}

$users = $userObj->all();
$page = 'pages/users.view.php';
require 'layout.php';
?>