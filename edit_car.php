<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['car_id'])) {
    $id = $_POST['car_id'];
    $status = $_POST['status'];
    $model = $_POST['model'];
    $type = $_POST['type'];
    $rate = $_POST['daily_rate'];
    
    $imageName = $_POST['existing_image']; // Default to old image

    // Handle Image Upload
    if (!empty($_FILES['car_image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        
        $fileName = time() . '_' . basename($_FILES['car_image']['name']);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['car_image']['tmp_name'], $targetFilePath)) {
            $imageName = $fileName;
        }
    }

    $sql = "UPDATE tbl_cars SET model=?, type=?, daily_rate=?, status=?, image=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$model, $type, $rate, $status, $imageName, $id])) {
        header("Location: index.php?msg=updated");
    } else {
        echo "Error updating record.";
    }
}