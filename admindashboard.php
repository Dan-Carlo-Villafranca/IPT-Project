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
    </style>
</head>
<body class="bg-slate-50">
    <div class="flex min-h-screen">
        <aside class="w-64 glass-sidebar text-white flex flex-col fixed h-full">
            <div class="p-8">
                <h1 class="text-2xl font-bold tracking-tighter text-indigo-400">DriveElite</h1>
                <span class="text-[10px] bg-indigo-500/20 text-indigo-300 px-2 py-1 rounded-md uppercase font-bold mt-2 inline-block">Admin Portal</span>
            </div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="#" class="flex items-center space-x-3 p-3 bg-indigo-600 rounded-xl text-white shadow-lg shadow-indigo-500/20">
                    <i class="fa-solid fa-gauge-high w-5"></i> <span>System Overview</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-users w-5"></i> <span>Manage Staff</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-car w-5"></i> <span>Full Inventory</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
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
                <a href="auth.php?action=logout" class="flex items-center space-x-3 p-3 text-red-400 hover:bg-red-500/10 rounded-xl transition w-full">
                    <i class="fa-solid fa-power-off"></i> <span>Logout</span>
                </a>
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