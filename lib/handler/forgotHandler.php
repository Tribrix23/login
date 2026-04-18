<?php
require_once __DIR__ . "/../database/db.php";
require_once __DIR__ . "/../api/forgotMailApi.php";

function forgot($data)
{
    global $pdo;

    $email = $data["email"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return json_encode([
            "success" => false,
            "message" => "Account does not exists"
        ]);
    }

    $token = bin2hex(random_bytes(32));
    $expiresAt = (new DateTime('+30 minutes'))->format('Y-m-d H:i:s');

    $stmt = $pdo->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");
    $stmt->execute([$user['id'], $token, $expiresAt]);

    $emailResult = sendPasswordReset($email, $token);

    if (!$emailResult['success']) {
        return json_encode([
            "success" => false,
            "message" => "Failed to send reset email. Please try again."
        ]);
    }

    return json_encode([
        "success" => true,
        "message" => "Password reset link sent to your email"
    ]);
}
?>