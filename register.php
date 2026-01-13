<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin | FoodZone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            /* BACKGROUND DIGANTI JADI GAMBAR */
            background-image: url('assets/images/background2.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
        .bg-navy { background-color: #2D405E; }
        .text-navy { color: #2D405E; }
        .btn-accent { background-color: #C84B31; transition: all 0.3s; }
        .btn-accent:hover { background-color: #A93D28; transform: translateY(-2px); }
        .input-field { background-color: #fcfbf8; border: 1px solid #e5e0d3; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-navy rounded-2xl shadow-xl mb-4 overflow-hidden p-0">
                <img src="assets/images/logo.png" alt="Logo" class="w-full h-full object-cover">
            </div>
            <h1 class="text-3xl font-bold text-navy italic">FoodZone Admin</h1>
            <p class="text-stone-500 text-sm mt-1 uppercase tracking-widest font-semibold">Account Registration</p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl p-10 border border-stone-200">
            <form action="auth_register.php" method="POST" class="space-y-5">
                <div>
                    <label class="block text-[10px] font-bold text-stone-400 uppercase tracking-[0.2em] mb-2 ml-1">Full Name</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-stone-300">
                            <i class="fas fa-id-badge"></i>
                        </span>
                        <input type="text" name="fullname" required
                            class="input-field w-full pl-11 pr-4 py-4 rounded-2xl outline-none transition text-navy"
                            placeholder="Ex: Alexander Graham">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-stone-400 uppercase tracking-[0.2em] mb-2 ml-1">Email System</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-stone-300">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" required
                            class="input-field w-full pl-11 pr-4 py-4 rounded-2xl outline-none transition text-navy"
                            placeholder="admin@foodzone.com">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-stone-400 uppercase tracking-[0.2em] mb-2 ml-1">Security Key</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-stone-300">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" required
                            class="input-field w-full pl-11 pr-4 py-4 rounded-2xl outline-none transition text-navy"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        class="btn-accent w-full text-white font-bold py-4 rounded-2xl shadow-lg shadow-red-100 uppercase tracking-widest text-xs">
                        Create Admin Account
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-stone-100 text-center">
                <p class="text-sm text-stone-500">
                    Already have access? 
                    <a href="index.php" class="text-navy font-bold hover:underline underline-offset-4 ml-1">Login here</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>