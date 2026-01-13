<?php
session_start();
include 'koneksi.php';

// --- CEK SESSION & COOKIES ---
if (!isset($_SESSION['id_admin'])) {
    if (isset($_COOKIE['id_admin']) && isset($_COOKIE['key'])) {
        $id_cookie = $_COOKIE['id_admin'];
        $key_cookie = $_COOKIE['key'];
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id_admin = '$id_cookie'");
        if ($row = mysqli_fetch_assoc($result)) {
            if ($key_cookie === hash('sha256', $row['email'])) {
                $_SESSION['id_admin'] = $row['id_admin'];
                $_SESSION['fullname'] = $row['fullname'];
            }
        }
    }
}

if (!isset($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}

// Simulasi Data Menu
$menus = [
    ["name" => "Asian Mix Salad", "price" => "45k", "img" => "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&q=80&w=500"],
    ["name" => "Healthy Green Poke", "price" => "52k", "img" => "https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&q=80&w=500"],
    ["name" => "Premium Miso Ramen", "price" => "65k", "img" => "https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&q=80&w=500"],
    ["name" => "Salmon Teriyaki", "price" => "88k", "img" => "https://images.unsplash.com/photo-1467003909585-2f8a72700288?auto=format&fit=crop&q=80&w=500"],
    ["name" => "Ebi Tempura", "price" => "40k", "img" => "https://images.unsplash.com/photo-1562607311-477053e1d932?auto=format&fit=crop&q=80&w=500"],
    ["name" => "Chicken Katsu", "price" => "42k", "img" => "https://images.unsplash.com/photo-1598514983318-2f64f8f4796c?auto=format&fit=crop&q=80&w=500"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | FoodZone Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #E9E3D5; color: #2D405E; height: 100vh; overflow: hidden; }
        .bg-navy { background-color: #2D405E; }
        .accent-red { background-color: #C84B31; }
        .sidebar-link:hover { background-color: rgba(255,255,255,0.1); }
        .active-link { background-color: white; color: #2D405E !important; }
        .card-custom { background: white; border-radius: 2.5rem; border: 1px solid rgba(45, 64, 94, 0.05); transition: all 0.3s ease; }
        
        /* Area Scroll yang Mulus */
        .scroll-area { overflow-y: auto; scroll-behavior: smooth; }
        .scroll-area::-webkit-scrollbar { width: 5px; }
        .scroll-area::-webkit-scrollbar-track { background: transparent; }
        .scroll-area::-webkit-scrollbar-thumb { background: #C84B31; border-radius: 10px; }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="flex p-5 gap-5">

    <aside class="w-72 bg-navy rounded-[3rem] flex flex-col text-white shadow-2xl h-full shrink-0">
        <div class="p-10 text-center">
            <h1 class="text-2xl font-bold italic tracking-tighter">FoodZone.</h1>
        </div>
        <nav class="flex-1 px-6 space-y-2 overflow-y-auto no-scrollbar">
            <a href="#" class="flex items-center gap-4 p-4 rounded-2xl active-link font-bold shadow-lg transition"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="#" class="sidebar-link flex items-center gap-4 p-4 rounded-2xl text-stone-400 transition"><i class="fas fa-utensils"></i> Menus</a>
            <a href="#" class="sidebar-link flex items-center gap-4 p-4 rounded-2xl text-stone-400 transition"><i class="fas fa-chart-pie"></i> Analysis</a>
            <a href="#" class="sidebar-link flex items-center gap-4 p-4 rounded-2xl text-stone-400 transition"><i class="fas fa-history"></i> History</a>
        </nav>
        <div class="p-8 mt-auto">
            <div class="bg-white/5 rounded-[2.5rem] p-6 border border-white/10 text-center">
                <p class="text-[10px] text-stone-400 mb-3 tracking-widest uppercase font-bold">Administrator</p>
                <a href="logout.php" class="block w-full py-3 accent-red text-white rounded-xl text-xs font-bold hover:brightness-110 transition">LOGOUT</a>
            </div>
        </div>
    </aside>

    <main class="flex-[2] flex flex-col h-full scroll-area pr-2">
        <header class="flex justify-between items-center mb-8 shrink-0">
            <div>
                <h2 class="text-2xl font-bold">Halo, <?php echo explode(' ', $_SESSION['fullname'])[0]; ?>!</h2>
                <p class="text-stone-500 text-sm">Ayo kelola pesanan masuk hari ini.</p>
            </div>
            <div class="relative w-80">
                <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-stone-300"></i>
                <input type="text" placeholder="Search menu..." class="w-full pl-14 pr-6 py-4 rounded-2xl bg-white/60 border-none shadow-sm outline-none focus:bg-white transition-all">
            </div>
        </header>

        <div class="accent-red rounded-[3rem] p-10 flex items-center justify-between text-white shadow-xl mb-8 shrink-0 relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-3xl font-bold mb-2">Voucher 20% OFF</h3>
                <p class="text-white/70 text-sm">Promosi sedang berjalan untuk kategori Ramen.</p>
            </div>
            <i class="fas fa-fire absolute right-10 text-8xl opacity-10 rotate-12"></i>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-8 shrink-0">
            <div class="card-custom p-8 bg-white">
                <span class="text-xs font-bold text-stone-400 uppercase block mb-2 tracking-widest">Daily Revenue</span>
                <h3 class="text-3xl font-bold mb-4">Rp 42.5M</h3>
                <canvas id="chartRevenue" class="h-16"></canvas>
            </div>
            <div class="card-custom p-8 bg-white">
                <span class="text-xs font-bold text-stone-400 uppercase block mb-2 tracking-widest">Total Orders</span>
                <h3 class="text-3xl font-bold">1,284</h3>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-3 py-1 rounded-full">+12.5%</span>
                    <span class="text-[10px] text-stone-400 tracking-tight">Since yesterday</span>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center mb-6 px-2">
            <h4 class="font-bold text-navy">Menu Terpopuler</h4>
            <button class="text-xs font-bold text-stone-400 hover:text-navy transition">Lihat Semua <i class="fas fa-arrow-right ml-1"></i></button>
        </div>

        <div class="grid grid-cols-2 gap-6 pb-10">
            <?php foreach($menus as $menu): ?>
            <div class="card-custom p-6 group cursor-pointer bg-white">
                <div class="w-full h-44 bg-stone-100 rounded-[2rem] mb-5 overflow-hidden shadow-inner">
                    <img src="<?php echo $menu['img']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <h5 class="font-bold mb-3 text-navy"><?php echo $menu['name']; ?></h5>
                <div class="flex justify-between items-center">
                    <span class="font-bold accent-red text-white px-4 py-2 rounded-xl text-xs shadow-lg shadow-red-900/10">Rp <?php echo $menu['price']; ?></span>
                    <button class="w-11 h-11 bg-navy text-white rounded-xl shadow-lg shadow-navy/20 active:scale-90 transition"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <aside class="w-80 flex flex-col h-full scroll-area pr-2 shrink-0">
        <div class="flex justify-end gap-3 mb-8 shrink-0">
            <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-stone-400 shadow-sm border border-white"><i class="fas fa-bell"></i></div>
            <div class="w-12 h-12 bg-navy rounded-2xl flex items-center justify-center text-white shadow-lg"><i class="fas fa-user"></i></div>
        </div>

        <div class="bg-navy rounded-[3rem] p-8 text-white shadow-2xl mb-8 shrink-0 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <p class="text-[10px] text-white/50 uppercase tracking-[0.2em] mb-2 font-bold">Restaurant Balance</p>
            <h3 class="text-2xl font-bold mb-8 tracking-tight">Rp 120.500.000</h3>
            <button class="w-full bg-navy text-white py-4 rounded-2xl text-[10px] font-bold uppercase tracking-widest hover:bg-navy/90 transition shadow-[0_10px_20px_rgba(255,255,255,0.1)] active:scale-95 border border-white/10">
    Withdraw Funds
</button>
        </div>

        <div class="card-custom p-8 bg-white flex flex-col mb-5 shrink-0">
            <h4 class="font-bold mb-8 text-sm border-b border-stone-100 pb-4 text-navy">Pesanan Terbaru</h4>
            <div class="space-y-6">
                <?php for($i=1; $i<=8; $i++): ?>
                <div class="flex items-center gap-4 border-b border-dashed border-stone-100 pb-5 last:border-0">
                    <div class="w-12 h-12 bg-stone-50 rounded-2xl flex items-center justify-center text-navy shadow-sm"><i class="fas fa-utensils"></i></div>
                    <div class="flex-1">
                        <h6 class="text-[11px] font-bold text-navy">Order #ZF-0<?php echo $i; ?></h6>
                        <span class="text-[9px] text-stone-400 font-medium uppercase tracking-tighter italic">2 Menu • Rp 125k</span>
                    </div>
                    <span class="text-[9px] font-bold text-green-600 bg-green-50 px-2 py-1 rounded-md">PAID</span>
                </div>
                <?php endfor; ?>
            </div>
            
            <button class="w-full mt-10 bg-navy text-white py-4 rounded-2xl text-[10px] font-bold uppercase tracking-widest shadow-xl shadow-navy/20 hover:scale-[1.02] transition">
                Cetak Laporan
            </button>
        </div>
    </aside>

    <script>
        const ctx = document.getElementById('chartRevenue').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
                datasets: [{
                    data: [15, 25, 18, 30, 22, 45, 38],
                    borderColor: '#C84B31',
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 0
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { x: { display: false }, y: { display: false } }
            }
        });
    </script>
</body>
</html>