<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/User.php';
require_once __DIR__.'/includes/helpers.php';

if (is_logged_in()) {
    header("Location: " . BASE_URL . "tables.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = (new Database())->getConnection();
    $user = new User($db);

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $loggedInUser = $user->login($username, $password);

    if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser['id'];
        $_SESSION['user_data'] = $loggedInUser;
        set_flash('Giriş başarılı!', 'success');
        header("Location: " . BASE_URL . "tables.php");
        exit();
    } else {
        set_flash('Kullanıcı adı veya şifre hatalı.', 'danger');
        header("Location: " . BASE_URL . "login.php");
        exit();
    }
}

$page = 'pages/login.view.php';
require 'layout.php';
?>