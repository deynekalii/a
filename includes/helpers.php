<?php
// ... diğer fonksiyonlar ...
function set_flash($message, $type = 'info') {
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
}

function display_flash() {
    if (!empty($_SESSION['flash_message'])) {
        $type = $_SESSION['flash_type'] ?? 'info';
        echo '<div class="alert alert-'.$type.'">'.$_SESSION['flash_message'].'</div>';
        unset($_SESSION['flash_message'], $_SESSION['flash_type']);
    }
}
function require_login() {
    if (!is_logged_in()) {
        set_flash('Lütfen giriş yapınız.', 'danger');
        header('Location: login.php');
        exit();
    }
}
function is_logged_in() {
    return isset($_SESSION['user_data']);
}

function is_admin() {
    return isset($_SESSION['user_data']['role']) && $_SESSION['user_data']['role'] === 'admin';
}

function is_personel() {
    return isset($_SESSION['user_data']['role']) && $_SESSION['user_data']['role'] === 'personel';
}

function require_admin() {
    if (!is_admin()) {
        set_flash('Bu işlemi yapmaya yetkiniz yok!', 'danger');
        header('Location: ' . BASE_URL . 'dashboard.php');
        exit();
    }
}
?>