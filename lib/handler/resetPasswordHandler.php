<?php
require_once __DIR__ . "/../database/db.php";

function resetPassword($data)
{
    global $pdo;

    $token = $data["token"] ?? '';
    $password = $data["password"] ?? '';

    if (!$token || !$password) {
        return json_encode([
            "success" => false,
            "message" => "Token and password are required"
        ]);
    }

    // Verify token
    $stmt = $pdo->prepare('SELECT user_id, expires_at FROM password_resets WHERE token = ? LIMIT 1');
    $stmt->execute([$token]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$record) {
        return json_encode([
            "success" => false,
            "message" => "Invalid reset token"
        ]);
    }

    if (strtotime($record['expires_at']) < time()) {
        $pdo->prepare('DELETE FROM password_resets WHERE token = ?')->execute([$token]);
        return json_encode([
            "success" => false,
            "message" => "Reset token has expired"
        ]);
    }

    $userId = $record['user_id'];

    // Get user's current password to check if new password is same as old
    $stmt = $pdo->prepare('SELECT password FROM users WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $user['password'])) {
        return json_encode([
            "success" => false,
            "message" => "New password cannot be the same as your current password"
        ]);
    }

    // Hash the new password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update user password
    $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
    $stmt->execute([$hashedPassword, $userId]);

    // Delete used token
    $pdo->prepare('DELETE FROM password_resets WHERE token = ?')->execute([$token]);

    return json_encode([
        "success" => true,
        "message" => "Password has been reset successfully"
    ]);
}
?>
