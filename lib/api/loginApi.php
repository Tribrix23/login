<?php
require_once __DIR__ . "/../handler/loginHandler.php";

$data = json_decode(file_get_contents("php://input"), true);

login($data);
?>