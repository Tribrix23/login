<?php

require_once __DIR__ . "/../../config/config.php";

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_PUBLIC_NAME . ";charset=utf8mb4";
    $pdoPublic = new PDO($dsn, DB_USER, DB_PASS);

    $pdoPublic->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Database conn failed" . $e->getMessage());
}


?>