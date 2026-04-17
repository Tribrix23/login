<?php
require_once __DIR__ . "/../handler/registerHandler.php";

$data = json_decode(file_get_contents("php://input"), true);

echo register($data);
?>