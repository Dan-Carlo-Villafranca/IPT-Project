<?php
session_start();
require_once 'config.php';

// LOGOUT LOGIC
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: login.php");
    exit;
}

// LOGIN LOGIC
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameInput = trim($_POST['username']); 
    $passwordInput = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM tbl_users WHERE username = ? LIMIT 1");
    $stmt->execute([$usernameInput]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $isCorrect = false;
        if (password_verify($passwordInput, $user['password'])) {
            $isCorrect = true; 
        } elseif ($passwordInput === $user['password']) {
            $isCorrect = true; 
        }

        if ($isCorrect) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid password. Please try again.";
        }
}
}