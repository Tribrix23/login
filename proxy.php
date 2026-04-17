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

if ($page === 'resendVerify') {
    include "pages/resendVerify.php";
    exit;
}

if ($page === "reg") {
    include 'lib/api/registerApi.php';
    exit;
}


?>