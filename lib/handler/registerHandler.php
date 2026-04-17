<?php
require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/../api/mailApi.php';

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

    $stmt = $pdo->prepare("INSERT INTO users (email, password, is_active) VALUES (?, ?, 0)");
    $stmt->execute([$email, $hashedPassword]);

    $userID = $pdo->lastInsertId();
    $token = bin2hex(random_bytes(32));
    $expiresAt = date("Y-m-d H:i:s", strtotime("+1 day"));

    $stmt = $pdo->prepare("INSERT INTO email_verifications (user_id, token, expires_at) VALUES (?, ?, ?)");
    $stmt->execute([$userID, $token, $expiresAt]);

    $emailResult = sendVerificationEmail($email, $token);
    $warning = "";
    
    if (!$emailResult["success"]) {
        $warning = " (warning: verification email may not have been sent)";
    }

    return json_encode([
        "success" => true,
        "message" => "Registration successful. Please check your email to verify your account." . $warning
    ]);
}

?>