<!DOCTYPE html>
<html lang="en">
<head>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta charset="UTF-8">
    <title>DriveElite | Customer Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* This prevents the modal from flickering on page load */
        [x-cloak] { display: none !important; }
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-sidebar { background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-slate-50" x-data="{ showLogoutModal: false }"> <!-- Bag ong edit -- para mushow ang warning inig pislit sa button --> 
    <div class="flex min-h-screen">
        <aside class="w-64 glass-sidebar text-white flex flex-col fixed h-full">
            <div class="p-8">
                <h1 class="text-2xl font-bold tracking-tighter text-indigo-400">DriveElite</h1>
            </div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="#" class="flex items-center space-x-3 p-3 bg-indigo-600 rounded-xl text-white">
                    <i class="fa-solid fa-car-side w-5"></i> <span>Browse Cars</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-clock-rotate-left w-5"></i> <span>My Rentals</span>
                </a>
            </nav>
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center space-x-3 mb-4 px-2">
                    <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center font-bold">
                        <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                    </div>
                    <div>
                        <p class="text-sm font-semibold"><?php echo $_SESSION['username']; ?></p>
                        <p class="text-xs text-slate-500">Customer</p>
                    </div>
                </div>
                <button @click.prevent="$dispatch('open-logout')" class="flex items-center space-x-3 p-3 text-red-400 hover:bg-red-500/10 rounded-xl transition w-full text-left">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Log Out</span>
                </button>
            </div>
        </aside>

        <main class="ml-64 flex-1 p-8">
            <header class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800">Available Vehicles</h2>
                    <p class="text-slate-500">Choose your ride for today, <?php echo $_SESSION['username']; ?>!</p>
                </div>
                </header>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-400 text-sm uppercase">
                        <tr>
                            <th class="px-6 py-4">Vehicle</th>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">Price / Day</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php foreach ($cars as $car): ?>
                        <tr class="group hover:bg-slate-100/50 transition-all duration-300">
                            <td class="px-6 py-6">
                                <div class="flex items-center gap-6">
                                    <div class="relative overflow-hidden rounded-2xl border border-slate-200 shadow-sm bg-white 
                                                h-16 w-24 group-hover:h-32 group-hover:w-48 transition-all duration-500 ease-out">
                                        
                                        <?php if (!empty($car['image'])): ?>
                                            <img src="Cars/<?php echo $car['image']; ?>" 
                                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        <?php else: ?>
                                            <div class="h-full w-full flex items-center justify-center bg-indigo-50">
                                                <i class="fa-solid fa-car text-indigo-200 text-xl group-hover:text-3xl transition-all"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div>
                                        <p class="font-bold text-slate-800 text-lg group-hover:text-indigo-600 transition-colors">
                                            <?php echo htmlspecialchars($car['model']); ?>
                                        </p>
                                        <div class="flex flex-col gap-1 mt-1">
                                            <span class="text-[10px] text-slate-400 uppercase font-black tracking-widest">
                                                Condition: <span class="text-slate-600"><?php echo htmlspecialchars($car['status'] ?? 'Good'); ?></span>
                                            </span>
                                            <span class="text-[10px] text-slate-400 uppercase font-black tracking-widest">
                                                Color: <span class="text-slate-600"><?php echo htmlspecialchars($car['color'] ?? 'Standard'); ?></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-white border border-slate-200 rounded-full text-xs font-bold text-slate-500">
                                    <?php echo htmlspecialchars($car['type']); ?>
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-indigo-600 font-black text-xl">₱<?php echo number_format($car['daily_rate'], 2); ?></span>
                                    <span class="text-[10px] text-slate-400 font-bold">PER DAY</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <button class="bg-indigo-600 text-white px-8 py-3 rounded-2xl text-sm font-black hover:bg-slate-900 transition-all shadow-lg shadow-indigo-100 active:scale-95">
                                    Rent Now
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <div x-data="{ showLogoutModal: false }" @open-logout.window="showLogoutModal = true">
    <div x-show="showLogoutModal" 
         class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto" 
         x-cloak>
        
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>

        <div x-show="showLogoutModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="relative bg-white rounded-[2rem] max-w-sm w-full p-8 shadow-2xl border border-slate-100">
            
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-50 mb-6">
                    <i class="fa-solid fa-arrow-right-from-bracket text-red-500 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Sign Out?</h3>
                <p class="text-slate-500 mb-8">Are you sure you want to log out of your DriveElite account?</p>
                
                <div class="flex flex-col gap-3">
                    <a href="auth.php?action=logout" 
                       class="w-full py-4 bg-red-500 hover:bg-red-600 text-white font-bold rounded-2xl transition shadow-lg shadow-red-100">
                        Yes, Log Me Out
                    </a>
                    <button @click="showLogoutModal = false" 
                            class="w-full py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl transition">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>