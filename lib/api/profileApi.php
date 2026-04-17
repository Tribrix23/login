<?php
require_once __DIR__ . "/../handler/profileHandler.php";

$data = json_decode(file_get_contents("php://input"), true);

echo login($data);
?>