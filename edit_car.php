<?php
session_start();
require_once 'config.php';

// Only allow Admins to perform this action
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['car_id'])) {
    $id = $_POST['car_id'];
    $model = trim($_POST['model']);
    $type = trim($_POST['type']);
    $rate = $_POST['daily_rate'];
    $status = $_POST['status'];

    try {
        $sql = "UPDATE tbl_cars SET model=?, type=?, daily_rate=?, status=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$model, $type, $rate, $status, $id])) {
            header("Location: index.php?msg=updated");
            exit;
        }
    } catch (PDOException $e) {
        die("Error updating record: " . $e->getMessage());
    }
}
?>