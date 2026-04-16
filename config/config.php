<?php

define("DB_HOST", "localhost");
define("DB_NAME", "users");
define("DB_USER", "root");
define("DB_PASS", "");


define("BASE_URL", "localhost/login");

define("SITE_NAME", "Project Web");


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>