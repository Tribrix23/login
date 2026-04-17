<?php
require_once __DIR__ . "/../../config/config.php";
function sendVerificationEmail($toEmail, $token)
{

    $apiKey = PRIVATE_API_KEY;

    $baseUrl = "http://localhost/login";

    $verificationLink = $baseUrl . "/lib/api/verify.php?token=" . urlencode($token);

    $data = [
        "sender" => [
            "name" => "Project Web",
            "email" => "tribrix23@gmail.com"
        ],
        "to" => [
            [
                "email" => $toEmail
            ]
        ],
        "subject" => "Verify your email address",
        "htmlContent" => "
            <div style='font-family: Arial, sans-serif;'>
                <h2>Welcome 👋</h2>
                <p>Thanks for registering!</p>
                <p>Please verify your email by clicking the button below:</p>
                <a href='{$verificationLink}' 
                   style='display:inline-block;padding:10px 20px;background:#4CAF50;color:#fff;text-decoration:none;border-radius:5px;'>
                   Verify Email
                </a>
                <p>If you didn’t create an account, you can ignore this email.</p>
            </div>
        "
    ];

    $ch = curl_init("https://api.brevo.com/v3/smtp/email");

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "api-key: $apiKey",
        "Content-Type: application/json",
        "Accept: application/json"
    ]);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = curl_error($ch);
        $ch = null;
        return [
            "success" => false,
            "error" => $error
        ];
    }

    $ch = null;

    return [
        "success" => true,
        "response" => $response
    ];
}