<?php
session_start();
include 'koneksi.php';

// Jika sudah login, lempar ke dashboard
if (isset($_SESSION['id_admin'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FoodZone Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
                font-family: 'Plus Jakarta Sans', sans-serif;
                background-image: url('assets/images/background4.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                min-height: 100vh;
            }
        .bg-navy { background-color: #2D405E; }
        .text-navy { color: #2D405E; }
        .btn-accent { background-color: #C84B31; transition: all 0.3s; }
        .btn-accent:hover { background-color: #A93D28; transform: translateY(-2px); }
    </style>
</head>
<div id="cookie-banner" class="fixed bottom-6 left-6 right-6 md:left-auto md:right-6 md:w-96 bg-navy text-white p-6 rounded-[2rem] shadow-2xl border border-white/10 transform translate-y-20 opacity-0 transition-all duration-500 z-50">
    <div class="flex items-start gap-4">
        <div class="bg-white/10 p-3 rounded-xl">
            <i class="fas fa-cookie-bite text-xl text-yellow-500"></i>
        </div>
        <div>
            <h4 class="font-bold mb-1">Cookie Policy</h4>
            <p class="text-xs text-stone-300 leading-relaxed mb-4">Kami menggunakan cookies untuk memastikan kamu tetap login dan mendapatkan pengalaman terbaik di FoodZone.</p>
            <button onclick="acceptCookies()" class="bg-white text-navy text-[10px] font-bold px-6 py-2 rounded-full uppercase tracking-widest hover:bg-stone-200 transition">
                Terima Cookies
            </button>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk munculin banner kalo user belum pernah klik 'Terima'
    window.onload = function() {
        if (!localStorage.getItem('cookiesAccepted')) {
            const banner = document.getElementById('cookie-banner');
            banner.classList.remove('translate-y-20', 'opacity-0');
            banner.classList.add('translate-y-0', 'opacity-100');
        }
    }

    // Fungsi pas tombol diklik
    function acceptCookies() {
        localStorage.setItem('cookiesAccepted', 'true');
        const banner = document.getElementById('cookie-banner');
        banner.classList.add('translate-y-20', 'opacity-0');
        setTimeout(() => { banner.style.display = 'none'; }, 500);
    }
</script>
<body class="min-h-screen flex items-center justify-center p-6">

    <div class="max-w-2xl w-full bg-white rounded-[3rem] shadow-2xl overflow-hidden flex flex-col md:flex-row border border-stone-200">
        <div class="md:w-1/2 bg-navy p-12 text-white flex flex-col justify-between relative">
            <div class="absolute bottom-0 right-0 opacity-10">
                <i class="fas fa-water text-[150px]"></i>
            </div>
            
            <div class="relative z-10">
                <div class="mb-8">
                    <img src="assets/images/logo.png" alt="Logo" class="h-20 w-auto object-contain">
                </div>
                <h1 class="text-4xl font-bold mb-4 italic">FoodZone Admin</h1>
                <p class="text-stone-300 leading-relaxed text-xs">Sistem integrasi manajemen restoran. Selaraskan menu dan pesanan pelanggan dalam satu kendali.</p>
            </div>
            
            <div class="text-[10px] text-stone-400 relative z-10">
                &copy; 2024 FoodZone Premium Experience.
            </div>
        </div>

        <div class="flex-1 p-12 md:p-10">
            <h2 class="text-2xl font-bold text-navy mb-2">Welcome Back</h2>
            <p class="text-gray-400 mb-8 text-xs">Log in to manage your Asia-inspired menu.</p>

            <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal'): ?>
                <div class="bg-red-50 text-red-600 p-3 rounded-xl text-[10px] font-bold mb-5 border border-red-100">
                    Email atau Password salah!
                </div>
            <?php endif; ?>

            <form action="auth_login.php" method="POST" class="space-y-4">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Email Control</label>
                    <input type="email" name="email" required class="w-full px-6 py-3 bg-stone-50 border border-stone-100 rounded-2xl focus:ring-2 focus:ring-navy-500 outline-none transition text-xs" placeholder="admin@foodzone.com">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Security Key</label>
                    <input type="password" name="password" required class="w-full px-6 py-3 bg-stone-50 border border-stone-100 rounded-2xl focus:ring-2 focus:ring-navy-500 outline-none transition text-xs" placeholder="••••••••">
                </div>
                
                <button type="submit" name="login" class="w-full btn-accent text-white font-bold py-4 rounded-2xl shadow-lg shadow-red-100 mt-4 uppercase tracking-widest text-xs">
                    Login
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-[10px] text-stone-500">
                    Don't have an account? 
                    <a href="register.php" class="text-navy font-bold hover:underline ml-1">Register Access</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>