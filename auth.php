<?php
session_start();
require_once 'config.php';

/**
 * SESSION SECURITY: PREVENT BACK BUTTON AFTER LOGOUT
 * This sends headers to the browser to prevent it from caching the page.
 * When a user clicks 'Back' after logging out, the browser will be forced 
 * to refresh and find no session, redirecting them to login.
 */
function prevent_back_button() {
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
}

/**
 * AUTHENTICATION GUARD
 * Add this to the top of your dashboard files.
 */
function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
}

// LOGOUT LOGIC
// if (isset($_GET['action']) && $_GET['action'] == 'logout') {
//     session_destroy();
//     header("Location: login.php");
//     exit;
// }


// --- LOGOUT LOGIC ---
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Clear the session array
    $_SESSION = array();

    // Effectively destroy the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destroy the session on the server
    session_destroy();
    
    // Redirect to login page
    header("Location: login.php");
    exit;
}

// LOGIN LOGIC
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameInput = trim($_POST['username']); 
    $passwordInput = $_POST['password'];

    if (empty($usernameInput) || empty($passwordInput)) {
        $error = "Please fill in all fields.";
        } else {
            $stmt = $pdo->prepare("SELECT * FROM tbl_users WHERE username = ? LIMIT 1");
            $stmt->execute([$usernameInput]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }


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
    } else {
            // 4. Handle wrong username (user not found in DB)
            $error = "Account not found or incorrect username.";
        }
}