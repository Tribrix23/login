<?php
require_once __DIR__ . "/../database/db.php";

$token = $_GET["token"] ?? '';

if (!$token) {
    die('Invalid Session');
}

$stmt = $pdo->prepare('SELECT user_id, expires_at FROM email_verifications WHERE token = ? LIMIT 1');
$stmt->execute([$token]);

$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    die('Invalid');
}

if (strtotime($record['expires_at']) < time()) {
    $pdo->prepare('DELETE FROM email_verifications WHERE token = ?')
        ->execute([$token]);

    die('Verification Link Expired');
}

$stmt = $pdo->prepare('UPDATE users SET is_active = 1, email_verified = 1 WHERE id = ?');
$stmt->execute([$record['user_id']]);

$stmt = $pdo->prepare('DELETE FROM email_verifications WHERE token = ?');
$stmt->execute([$token]);

echo "
    <h2>✅ Email Verified!</h2>
    <p>Your account is now active.</p>
    <a href='/'>Go to Login</a>
";

?>