<?php
require_once 'config.php'; // This provides the $pdo variable
session_start();

// 1. Flexible Case Check (Supports ADMIN or Admin)
$currentRole = $_SESSION['role'] ?? '';
if ($currentRole !== 'ADMIN' && $currentRole !== 'Admin') {
    header("Location: login.php");
    exit();
}

// 2. Fetch staff using the CORRECT variable ($pdo) and CORRECT table (tbl_users)
try {
    $query = "SELECT id, username, role FROM tbl_users WHERE role IN ('ADMIN', 'Admin', 'STAFF', 'Staff')";
    $stmt = $pdo->query($query);
    $staff_members = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // This will tell you exactly what's wrong if the table doesn't exist
    die("Database Error: " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Staff | DriveElite</title>
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
                <!-- <a href="index.php" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-gauge-high w-5"></i> <span>System Overview</span>
                </a>
                <a href="manage_staff.php" class="flex items-center space-x-3 p-3 bg-indigo-600 rounded-xl text-white shadow-lg">
                    <i class="fa-solid fa-user-shield w-5"></i> <span>Manage Staff</span>
                </a> -->
                <a href="index.php" class="flex items-center space-x-3 p-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <i class="fa-solid fa-gauge-high w-5"></i> <span>System Overview</span>
                </a>
                <a href="manage_staff.php" class="flex items-center space-x-3 p-3 bg-indigo-600 rounded-xl text-white shadow-lg shadow-indigo-500/20">
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
                <a href="auth.php?action=logout" class="flex items-center space-x-3 p-3 text-red-400 hover:bg-red-500/10 rounded-xl transition w-full">
                    <i class="fa-solid fa-power-off"></i> <span>Logout</span>
                </a>
            </div>
        </aside>

        <main class="ml-64 flex-1 p-8">
            <header class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800">Staff Management</h2>
                    <p class="text-slate-500">Add, edit, or remove system operators.</p>
                </div>
                <button onclick="toggleModal('addStaffModal')" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold flex items-center gap-2 hover:bg-indigo-700 transition shadow-lg">
                    <i class="fa-solid fa-user-plus text-sm"></i> Add New Staff
                </button>
            </header>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-400 text-xs uppercase font-bold">
                        <tr>
                            <th class="px-6 py-4">Username</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php foreach ($staff_members as $staff): ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 font-semibold text-slate-700"><?php echo $staff['username']; ?></td>
                            <!-- <td class="px-6 py-4 text-slate-500"><?php echo $staff['email']; ?></td> -->
                            <td class="px-6 py-4"><span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-md text-xs font-bold"><?php echo $staff['role']; ?></span></td>
                            <!-- <td class="px-6 py-4 text-green-500 font-bold text-xs uppercase"><?php echo $staff['status']; ?></td> -->
                            <td class="px-6 py-4 text-center flex justify-center gap-3">
                                <button onclick='openEditStaff(<?php echo json_encode($staff); ?>)' class="text-slate-400 hover:text-indigo-600 transition">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <a href="process_staff.php?delete=<?php echo $staff['id']; ?>" onclick="return confirm('Remove this staff member?')" class="text-slate-400 hover:text-red-600 transition">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <div id="addStaffModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] overflow-hidden">
            <div class="p-6 bg-slate-900 text-white flex justify-between">
                <h3 class="font-bold">Add New Staff</h3>
                <button onclick="toggleModal('addStaffModal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="process_staff.php" method="POST" class="p-8 space-y-4">
                <input type="hidden" name="action" value="add">
                <input type="text" name="username" placeholder="Username" class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500" required>
                <input type="email" name="email" placeholder="Email Address" class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500" required>
                <input type="password" name="password" placeholder="Password" class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500" required>
                <button class="w-full py-4 bg-indigo-600 text-white font-bold rounded-2xl">Create Account</button>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            document.getElementById(id).classList.toggle('hidden');
        }
        function openEditStaff(staff) {
            // Logic to populate an Edit Modal with 'staff' data
            alert("Editing: " + staff.username);
        }
    </script>
</body>
</html>