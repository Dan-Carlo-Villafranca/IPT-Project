<?php
require_once 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveElite | Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-50 p-4">
    <div class="w-full max-w-4xl bg-white shadow-2xl rounded-[2rem] overflow-hidden flex flex-col md:flex-row">
        <div class="md:w-1/2 bg-slate-900 p-12 text-white flex flex-col justify-between" 
             style="background-image: linear-gradient(rgba(15,23,42,0.8), rgba(15,23,42,0.8)), url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1000'); background-size: cover;">
            <div>
                <h1 class="text-3xl font-bold tracking-tighter text-indigo-400 mb-2">DriveElite</h1>
                <p class="text-slate-300">Management Information System</p>
            </div>
            <div>
                <h2 class="text-4xl font-bold mb-4 leading-tight">Control your fleet <br>with confidence.</h2>
            </div>
        </div>

        <div class="md:w-1/2 p-12 bg-white flex flex-col justify-center">
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Welcome Back</h3>
            <?php if($error): ?>
                <div class="mb-6 p-4 bg-red-50 text-red-600 text-sm rounded-2xl flex items-center gap-3 border border-red-100">
                    <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-2">Username</label>
                    <input type="text" name="username" required class="w-full px-5 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-2">Password</label>
                    <input type="password" name="password" required class="w-full px-5 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl outline-none transition">
                </div>
                <button type="submit" class="w-full py-4 bg-slate-900 hover:bg-black text-white font-bold rounded-2xl shadow-xl transition">Log In to Portal</button>
                <p class="mt-8 text-center text-sm text-slate-500">
                        Don't have an account? <a href="register.php" class="text-indigo-600 font-bold hover:underline">Register here</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>