<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/helpers.php';

// Oturumu temizle
session_unset();
session_destroy();

// Flash mesajı (set_flash fonksiyonu session_start gerektirir)
set_flash('Çıkış yapıldı.', 'success');
header("Location: login.php");
exit();
?>