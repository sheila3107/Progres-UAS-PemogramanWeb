<?php
session_start();

// 1. Hapus Session
session_unset();
session_destroy();

// 2. Hapus Cookies
setcookie('id_admin', '', time() - 3600, '/');
setcookie('key', '', time() - 3600, '/');

// 3. Kembali ke index.php
header("Location: index.php");
exit();
?>