<?php
$page = $_GET['page'] ?? '';


if ($page === 'login') {
    include "pages/login.php";
    exit;
}

if ($page === 'register') {
    include "pages/register.php";
    exit;
}

if ($page === 'forgotPassword') {
    include "pages/forgotPassword.php";
    exit;
}

if ($page === "reg") {
    include 'lib/api/registerApi.php';
    exit;
}

if ($page === 'log') {
    include 'lib/api/loginApi.php';
    exit;
}

if ($page === 'session') {
    include 'lib/handler/session.php';
    exit;
}

if ($page === 'profile') {
    include 'lib/api/profileApi.php';
    exit;
}

if ($page === 'FP') {
    include 'lib/api/forgotApi.php';
    exit;
}

if ($page === 'home') {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id'])) {
        header('Location: ./');
        exit;
    }
    include 'pages/home.php';
    exit;
}

if ($page === 'logout') {
    session_start();
    session_destroy();
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
    exit;
}


?>