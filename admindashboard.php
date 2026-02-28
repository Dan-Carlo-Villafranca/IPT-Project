<!DOCTYPE html>
<html lang="en">
<head>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta charset="UTF-8">
    <title>DriveElite | Admin Control</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-sidebar { background: #0f172a; }
    </style>
</head>
<body class="bg-slate-50" x-data="{ showLogoutModal: false }">
    <div class="flex min-h-screen">
        <aside class="w-64 glass-sidebar text-white flex flex-col fixed h-full">
            <div class="p-8">
                <h1 class="text-2xl font-bold tracking-tighter text-indigo-400">DriveElite</h1>
                <span class="text-[10px] bg-indigo-500/20 text-indigo-300 px-2 py-1 rounded-md uppercase font-bold mt-2 inline-block">Admin Portal</span>
            </div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="index.php" class="flex items-center space-x-3 p-3 bg-indigo-600 rounded-xl text-white shadow-lg shadow-indigo-500/20">
                    <i class="fa-solid fa-gauge-high w-5"></i> <span>System Overview</span>
                </a>
                <a href="manage_staff.php" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-users w-5"></i> <span>Manage Staff</span>
                </a>
                <a href="inventory.php" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-car w-5"></i> <span>Full Inventory</span>
                </a>
                <a href="customers.php" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-users w-5"></i> <span>Customers Section</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-file-invoice-dollar w-5"></i> <span>Revenue Reports</span>
                </a>
            </nav>
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center space-x-3 mb-4 px-2">
                    <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center font-bold text-white">
                        <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                    </div>
                    <div>
                        <p class="text-sm font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                        <p class="text-xs text-slate-500 italic">ADMIN</p>
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
                    <h2 class="text-3xl font-bold text-slate-800">Admin Dashboard</h2>
                    <p class="text-slate-500">System-wide performance and fleet management.</p>
                </div>
                
                <button onclick="toggleModal()" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold flex items-center gap-2 hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                    <i class="fa-solid fa-plus text-sm"></i> Add New Car
                </button>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-car-side text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-semibold">Total Fleet</p>
                    <h3 class="text-2xl font-bold text-slate-800"><?php echo count($cars); ?> Vehicles</h3>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-semibold">System Access</p>
                    <h3 class="text-2xl font-bold text-slate-800">Admin-Only Creation</h3>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-peso-sign text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-semibold">Monthly Revenue</p>
                    <h3 class="text-2xl font-bold text-slate-800">₱12,450.00</h3>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800">Recent Vehicle Additions</h3>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-400 text-sm uppercase">
                        <tr>
                            <th class="px-6 py-4">Vehicle Model</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Daily Rate</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php if (empty($cars)): ?>
                            <tr><td colspan="4" class="px-6 py-10 text-center text-slate-400">No vehicles in inventory.</td></tr>
                        <?php else: ?>
                            <?php foreach (array_slice(array_reverse($cars), 0, 5) as $car): ?>
                            <tr>
                                <td class="px-6 py-4 font-semibold text-slate-700"><?php echo htmlspecialchars($car['model']); ?></td>
                                <td class="px-6 py-4 text-slate-500"><?php echo htmlspecialchars($car['type'] ?? 'General'); ?></td>
                                <td class="px-6 py-4 text-indigo-600 font-bold">₱<?php echo number_format($car['daily_rate'], 2); ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-bold uppercase">
                                        <?php echo htmlspecialchars($car['status']); ?>
                                    </span>
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
        <div class="bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-900 text-white">
                <h3 class="text-xl font-bold">Add New Vehicle</h3>
                <button onclick="toggleModal()" class="text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            
            <form action="add_car.php" method="POST" class="p-8 space-y-5">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-2">Vehicle Model</label>
                    <input type="text" name="model" required placeholder="e.g. Tesla Model S" 
                        class="w-full px-5 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl outline-none transition">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 mb-2">Category / Type</label>
                        <input type="text" name="type" required placeholder="Sedan, SUV..." 
                            class="w-full px-5 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 mb-2">Daily Rate (₱)</label>
                        <input type="number" name="daily_rate" step="0.01" required placeholder="0.00" 
                            class="w-full px-5 py-4 bg-slate-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl outline-none transition">
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl shadow-indigo-200 transition">
                    Confirm & Add to Fleet
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('addCarModal');
            modal.classList.toggle('hidden');
        }

        // Close modal if user clicks outside the white box
        window.onclick = function(event) {
            const modal = document.getElementById('addCarModal');
            if (event.target == modal) {
                toggleModal();
            }
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveElite | Admin Control</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-sidebar { background: #0f172a; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="bg-slate-50" x-data="{ showLogoutModal: false }">
    <div class="flex min-h-screen">
        <aside class="w-64 glass-sidebar text-white flex flex-col fixed h-full">
            <div class="p-8">
                <h1 class="text-2xl font-bold tracking-tighter text-indigo-400">Rent N' Ride</h1>
                <span class="text-[10px] bg-indigo-500/20 text-indigo-300 px-2 py-1 rounded-md uppercase font-bold mt-2 inline-block italic">Admin Portal</span>
            </div>
            
            <nav class="flex-1 px-4 space-y-2">
                <a href="index.php" class="flex items-center space-x-3 p-3 bg-indigo-600 rounded-xl text-white shadow-lg shadow-indigo-500/20 transition">
                    <i class="fa-solid fa-gauge-high w-5"></i> <span>System Overview</span>
                </a>
                <a href="manage_staff.php" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-user-shield w-5"></i> <span>Manage Staff</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-car w-5"></i> <span>Full Inventory</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center space-x-3 mb-4 px-2">
                    <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center font-bold text-white ring-2 ring-indigo-500/20">
                        <?php echo strtoupper(substr($_SESSION['username'] ?? 'A', 0, 1)); ?>
                    </div>
                    <div>
                        <p class="text-sm font-semibold truncate w-32"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></p>
                        <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-wider">Super Admin</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="ml-64 flex-1 p-8">
            <?php if(isset($_GET['msg'])): ?>
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100 flex items-center gap-3">
                    <i class="fa-solid fa-circle-check"></i>
                    <span class="font-bold text-sm">
                        <?php 
                            if($_GET['msg'] == 'car_added') echo "New vehicle added successfully.";
                            if($_GET['msg'] == 'updated') echo "Vehicle details updated.";
                            if($_GET['msg'] == 'deleted') echo "Vehicle removed from fleet.";
                        ?>
                    </span>
                </div>
            <?php endif; ?>

            <header class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">System Control</h2>
                    <p class="text-slate-500">Global fleet oversight & administrative access.</p>
                </div>
                <button onclick="openModal('addCarModal')" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold flex items-center gap-2 hover:bg-indigo-700 transition shadow-xl shadow-indigo-200">
                    <i class="fa-solid fa-plus text-sm"></i> Add New Car
                </button>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-car-side text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-semibold uppercase tracking-wider">Total Fleet</p>
                    <h3 class="text-2xl font-bold text-slate-800"><?php echo count($cars); ?> Vehicles</h3>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-shield-halved text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-semibold uppercase tracking-wider">Access Protocol</p>
                    <h3 class="text-2xl font-bold text-slate-800">Admin-Only</h3>
                    <p class="text-[10px] text-emerald-500 font-bold mt-1">Staff accounts must be created by Admin</p>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-money-bill-trend-up text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-semibold uppercase tracking-wider">Monthly Revenue</p>
                    <h3 class="text-2xl font-bold text-slate-800">₱74,250.00</h3>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800">Vehicle Inventory</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50/50 text-slate-400 text-[10px] uppercase font-bold">
                            <tr>
                                <th class="px-6 py-4">Vehicle Model</th>
                                <th class="px-6 py-4">Category</th>
                                <th class="px-6 py-4">Daily Rate</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php foreach ($cars as $car): ?>
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4 font-semibold text-slate-700"><?php echo htmlspecialchars($car['model']); ?></td>
                                <td class="px-6 py-4">
                                    <span class="text-xs bg-slate-100 text-slate-600 px-2 py-1 rounded-md">
                                        <?php echo htmlspecialchars($car['type']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-indigo-600 font-bold">₱<?php echo number_format($car['daily_rate'], 2); ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-bold uppercase">
                                        <?php echo htmlspecialchars($car['status']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center flex justify-center gap-2">
                                    <button onclick='openEditModal(<?php echo json_encode($car); ?>)' class="text-slate-400 hover:text-indigo-600 transition p-2">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <a href="delete_car.php?id=<?php echo $car['id']; ?>" onclick="return confirm('Remove this vehicle?')" class="text-slate-400 hover:text-red-600 transition p-2">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

        function openEditModal(car) {
            document.getElementById('edit_car_id').value = car.id;
            document.getElementById('edit_model').value = car.model;
            document.getElementById('edit_type').value = car.type;
            document.getElementById('edit_rate').value = car.daily_rate;
            document.getElementById('edit_status').value = car.status;
            openModal('editCarModal');
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