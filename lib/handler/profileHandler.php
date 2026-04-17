<?php
session_start();
require_once __DIR__ . "/../database/publicDB.php";

$user_id = $_SESSION['user_id'];

global $pdoPublic;

$stmt = $pdoPublic->prepare('SELECT * FROM profile WHERE user_id = ?');
$stmt->execute([$user_id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode([$user]);

exit;
?>