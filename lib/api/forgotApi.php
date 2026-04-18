<?php
require_once __DIR__ . "/../handler/forgotHandler.php";

$data = json_decode(file_get_contents("php://input"), true);

echo forgot($data);
?>