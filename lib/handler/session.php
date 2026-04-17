<?php
session_start();
header('Content-Type: application/json');

$page = $_GET['page'] ?? '';

if ($page === 'session') {
    echo json_encode([
        "loggedIn" => isset($_SESSION['user_id']),
        "user_id" => $_SESSION['user_id'] ?? null
    ]);
    exit;
}
?>