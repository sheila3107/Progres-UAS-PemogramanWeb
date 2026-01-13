<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    
    if (mysqli_num_rows($query) === 1) {
        $user = mysqli_fetch_assoc($query);
        
        if (password_verify($password, $user['password'])) {
            // --- MEKANISME SESSION ---
            $_SESSION['id_admin'] = $user['id_admin'];
            $_SESSION['fullname'] = $user['fullname'];
            
            // --- MEKANISME COOKIES (Berlaku 30 Hari) ---
            setcookie('id_admin', $user['id_admin'], time() + (60 * 60 * 24 * 30), '/');
            setcookie('key', hash('sha256', $user['email']), time() + (60 * 60 * 24 * 30), '/');
            
            header("Location: dashboard.php");
            exit();
        }
    }
    
    // Diarahkan ke index.php jika gagal
    echo "<script>alert('Akses Ditolak! Email atau Password Salah'); window.location='index.php';</script>";
}
?>