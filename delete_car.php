<?php
session_start();
require_once 'config.php';
if ($_SESSION['role'] !== 'ADMIN') exit;

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM tbl_cars WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: index.php?msg=deleted");
}
?>