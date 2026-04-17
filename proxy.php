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

if ($page === 'home') {
    include 'pages/home.php';
    exit;
}


?>