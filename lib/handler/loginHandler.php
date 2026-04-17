<?php
session_set_cookie_params([
    "lifetime" => 60 * 60 * 24 * 7,
    "path" => "/",
    "httponly" => true,
    "secure" => false,
    "samesite" => "Strict",
]);

session_start();


require_once __DIR__ . "/../database/db.php";

function login($data)
{
    global $pdo;

    $email = $data["email"];
    $password = $data["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return json_encode([
            "success" => false,
            "message" => "Account does not exists"
        ]);
    }

    if (!password_verify($password, $user["password"])) {
        return json_encode([
            "success" => false,
            "message" => "Invalid Authentication"
        ]);
    }

    if (!$user["is_active"] || !$user["email_verified"]) {
        return json_encode([
            "success" => false,
            "message" => "Activate your account"
        ]);
    }

    session_regenerate_id(true);

    $_SESSION["user_id"] = $user["id"];
    $_SESSION["email"] = $user["email"];
    $_SESSION["loggedIn"] = true;

    return json_encode([
        "success" => true,
        "message" => "Login Successful",
        "user" => [
            "id" => $user["id"],
            "email" => $user["email"],
        ]
    ]);

}

?>