<?php
session_start();
require_once 'config.php';

// Safety Check: Only Admins/Staff should access this
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'ADMIN' && $_SESSION['role'] !== 'STAFF')) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $model = trim($_POST['model']);
    $type = trim($_POST['type']);
    $rate = $_POST['daily_rate'];
    $status = 'Available'; // Default status for new cars

    if (!empty($model) && !empty($type) && !empty($rate)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tbl_cars (model, type, daily_rate, status) VALUES (?, ?, ?, ?)");
            $stmt->execute([$model, $type, $rate, $status]);
            
            // Redirect back to dashboard with success
            header("Location: index.php?msg=car_added");
            exit;
        } catch (PDOException $e) {
            die("Error adding car: " . $e->getMessage());
        }
    }
}
?>