<?php
require_once __DIR__ . "/../handler/resetPasswordHandler.php";

$data = json_decode(file_get_contents("php://input"), true);

echo resetPassword($data);
?>
