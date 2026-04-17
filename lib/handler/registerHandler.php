<?php
require_once __DIR__ . '/../database/db.php';

function register($data)
{
    global $pdo;

    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        return json_encode([
            "success" => false,
            "message" => "Email already exists"
        ]);
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (email, password, isActive) VALUES (?, ?, 0)");
    $stmt->execute([$email, $hashedPassword]);

    $userID = $pdo->lastInsertId();

    $token = bin2hex(random_bytes(32));

    $expiresAt = date("Y-m-d H:i:s", strtotime("+1 day"));

}

?>