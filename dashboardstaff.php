<!DOCTYPE html>
<html lang="en">
<head>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta charset="UTF-8">
    <title>DriveElite | Staff Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-sidebar { background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-slate-50" x-data="{ showLogoutModal: false }">
    <div class="flex min-h-screen">
        <aside class="w-64 glass-sidebar text-white flex flex-col fixed h-full">
            <div class="p-8">
                <h1 class="text-2xl font-bold tracking-tighter text-indigo-400">Rent N' Ride</h1>
            </div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="#" class="flex items-center space-x-3 p-3 bg-indigo-600 rounded-xl text-white">
                    <i class="fa-solid fa-chart-pie w-5"></i> <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-car-side w-5"></i> <span>Fleet Management</span>
                </a>
            </nav>
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center space-x-3 mb-4 px-2">
                    <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center font-bold">
                        <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                    </div>
                    <div>
                        <p class="text-sm font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                        <p class="text-xs text-slate-500"><?php echo htmlspecialchars($role); ?></p>
                    </div>
                </div>
                <button @click.prevent="$dispatch('open-logout')" class="flex items-center space-x-3 p-3 text-red-400 hover:bg-red-500/10 rounded-xl transition w-full text-left">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Log Out</span>
                </button>
            </div>
        </aside>

        <main class="ml-64 flex-1 p-8">
            
            <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100 flex items-center gap-3">
                    <i class="fa-solid fa-circle-check"></i>
                    <span class="font-bold text-sm">New vehicle successfully added to the fleet!</span>
                </div>
            <?php endif; ?>

            <header class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800">Fleet Overview</h2>
                    <p class="text-slate-500">Manage your vehicle inventory and status.</p>
                </div>
                <button onclick="toggleModal()" class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold flex items-center gap-2 hover:bg-black transition shadow-lg">
                    <i class="fa-solid fa-plus"></i> Add New Car
                </button>
            </header>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-400 text-sm uppercase">
                        <tr>
                            <th class="px-6 py-4">Vehicle Model</th>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Daily Rate</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php if (empty($cars)): ?>
                            <tr><td colspan="5" class="px-6 py-10 text-center text-slate-400">No vehicles found.</td></tr>
                        <?php else: ?>
                            <?php foreach (array_reverse($cars) as $car): ?>
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4 font-semibold text-slate-700"><?php echo htmlspecialchars($car['model']); ?></td>
                                <td class="px-6 py-4 text-slate-500"><?php echo htmlspecialchars($car['type']); ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase <?php echo ($car['status'] == 'Available') ? 'bg-green-100 text-green-600' : 'bg-amber-100 text-amber-600'; ?>">
                                        <?php echo htmlspecialchars($car['status']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-bold text-indigo-600">₱<?php echo number_format($car['daily_rate'], 2); ?></td>
                                <td class="px-6 py-4">
                                    <button class="text-indigo-600 font-semibold hover:underline">Edit</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <div id="addCarModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-900 text-white">
                <h3 class="text-xl font-bold">Add New Vehicle</h3>
                <button onclick="toggleModal()" class="text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            
            <form action="add_car.php" method="POST" class="p-8 space-y-5">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-2">Vehicle Model</label>
                    <input type="text" name="model" required placeholder="e.g. BMW M4" 
                        class="w-full px-5 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl outline-none transition">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 mb-2">Category</label>
                        <input type="text" name="type" required placeholder="Luxury, SUV..." 
                            class="w-full px-5 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 mb-2">Daily Rate (₱)</label>
                        <input type="number" name="daily_rate" step="0.01" required placeholder="0.00" 
                            class="w-full px-5 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl outline-none transition">
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl transition">
                    Add to Inventory
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('addCarModal');
            modal.classList.toggle('hidden');
        }

        // Close modal if user clicks outside of the box
        window.onclick = function(event) {
            const modal = document.getElementById('addCarModal');
            if (event.target == modal) {
                toggleModal();
            }
        }
    </script>
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
</body>
</html>