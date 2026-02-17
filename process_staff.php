<?php
require_once 'config.php';
session_start();

// Check if Admin
$role = $_SESSION['role'] ?? '';
if ($role !== 'ADMIN' && $role !== 'Admin') { exit("Unauthorized"); }

// Handle ADD
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $user = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO tbl_users (username, email, password, role) VALUES (?, ?, ?, 'STAFF')");
    $stmt->execute([$user, $email, $pass]);
    header("Location: manage_staff.php?success=1");
}

// Handle DELETE
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Logic: Don't let an admin delete themselves
    if ($id != $_SESSION['user_id']) {
        $stmt = $pdo->prepare("DELETE FROM tbl_users WHERE id = ? AND role != 'ADMIN'");
        $stmt->execute([$id]);
    }
    header("Location: manage_staff.php?deleted=1");
}