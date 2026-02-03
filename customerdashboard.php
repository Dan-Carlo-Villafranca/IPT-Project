<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DriveElite | Customer Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-sidebar { background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-slate-50">
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
                <a href="auth.php?action=logout" class="flex items-center space-x-3 p-3 text-red-400 hover:bg-red-500/10 rounded-xl transition w-full">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Sign Out</span>
                </a>
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
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 font-semibold text-slate-700"><?php echo htmlspecialchars($car['model']); ?></td>
                            <td class="px-6 py-4 text-slate-500"><?php echo htmlspecialchars($car['type']); ?></td>
                            <td class="px-6 py-4 font-bold text-indigo-600">$<?php echo number_format($car['daily_rate'], 2); ?></td>
                            <td class="px-6 py-4 text-center">
                                <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-indigo-700 transition">
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
</body>
</html>