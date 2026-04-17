<?php
require_once __DIR__ . "/../../config/config.php";
function sendVerificationEmail($toEmail, $token)
{

    $apiKey = PRIVATE_API_KEY;

    $baseUrl = BASE_URL;

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
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Verify Your Email - Project Web</title>
    <style>
        /* Reset styles */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; }
        
        /* Typography */
        body { margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        
        /* Mobile responsive */
        @media screen and (max-width: 600px) {
            .email-container { width: 100% !important; padding: 10px !important; }
            .header-padding { padding: 20px 15px !important; }
            .content-padding { padding: 30px 20px !important; }
            .button { display: block !important; width: 100% !important; padding: 16px 20px !important; }
        }
    </style>
</head>
<body style='margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif; background-color: #f7f9fc;'>
    
    <!-- Preheader text (invisible preview) -->
    <div style='display: none; font-size: 1px; color: #f7f9fc; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'>
        Verify your email address to complete your Project Web account registration.
    </div>
    
    <!-- Main table -->
    <table role='presentation' cellpadding='0' cellspacing='0' width='100%' style='background-color: #f7f9fc;'>
        <tr>
            <td align='center' style='padding: 40px 20px;'>
                
                <!-- Email container -->
                <table role='presentation' cellpadding='0' cellspacing='0' width='600' class='email-container' style='max-width: 600px; width: 100%;'>
                    
                    <!-- Logo section -->
                    <tr>
                        <td align='center' style='padding: 30px 0 20px;'>
                            <table role='presentation' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td style='background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-radius: 12px; width: 50px; height: 50px; text-align: center; line-height: 50px; font-size: 24px; font-weight: 700; color: #ffffff;'>
                                        P
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Hero section with gradient -->
                    <tr>
                        <td style='background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-radius: 12px; padding: 30px 40px; text-align: center;'>
                            <h1 style='margin: 0 0 8px; color: #ffffff; font-size: 24px; font-weight: 700; line-height: 1.2;'>
                                Welcome to Project Web
                            </h1>
                            <p style='margin: 0; color: rgba(255,255,255,0.9); font-size: 15px; line-height: 1.5;'>
                                Your account is ready. Verify your email to get started.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- White content card -->
                    <tr>
                        <td style='background-color: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-top: -12px;'>
                            
                            <!-- Content section -->
                            <table role='presentation' cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                    <td class='content-padding' style='padding: 30px 40px;'>
                                        
                                        <!-- Greeting -->
                                        <p style='margin: 0 0 10px; color: #4a5568; font-size: 16px; line-height: 1.5;'>
                                            <strong>Hi there! 👋</strong>
                                        </p>
                                        
                                        <!-- Main message -->
                                        <p style='margin: 0 0 25px; color: #4a5568; font-size: 15px; line-height: 1.6;'>
                                            Thank you for registering with Project Web. Please verify your email address by clicking the button below. This ensures your account security and helps prevent unauthorized access.
                                        </p>
                                        
                                        <!-- CTA Button -->
                                        <table role='presentation' cellpadding='0' cellspacing='0' width='100%'>
                                            <tr>
                                                <td align='center'>
                                                    <a href='{$verificationLink}' class='button' style='display: inline-block; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #ffffff; text-decoration: none; border-radius: 50px; padding: 14px 35px; font-size: 15px; font-weight: 600; letter-spacing: 0.3px; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35);'>
                                                        ✓ Verify My Email
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Divider -->
                            <tr>
                                <td style='padding: 0 40px;'>
                                    <table role='presentation' cellpadding='0' cellspacing='0' width='100%'>
                                        <tr>
                                            <td style='border-top: 1px solid #e2e8f0; height: 1px;'></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <!-- Link section -->
                            <tr>
                                <td style='padding: 20px 40px 25px;'>
                                    <p style='margin: 0; color: #718096; font-size: 14px; line-height: 1.5; text-align: center;'>
                                        Having trouble with the button? Copy and paste this link into your browser:
                                    </p>
                                    <p style='margin: 8px 0 0; color: #6366f1; font-size: 12px; line-height: 1.5; word-break: break-all; text-align: center;'>
                                        {$verificationLink}
                                    </p>
                                </td>
                            </tr>
                            
                        </td>
                    </tr>
                    
                    <!-- Bottom notice -->
                    <tr>
                        <td style='padding: 25px 40px;'>
                            <table role='presentation' cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                    <td style='background-color: #edf2f7; border-radius: 8px; padding: 15px;'>
                                        <p style='margin: 0; color: #4a5568; font-size: 13px; line-height: 1.5;'>
                                            <strong>Note:</strong> If you did not create an account with Project Web, you can safely ignore this email. The verification link will expire after 24 hours for security purposes.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td align='center' style='padding: 30px 20px 10px;'>
                            <p style='margin: 0 0 8px; color: #718096; font-size: 12px; line-height: 1.5;'>
                                © 2024 Project Web. All rights reserved.
                            </p>
                            <p style='margin: 0; color: #a0aec0; font-size: 11px; line-height: 1.5;'>
                                This email was sent to <strong>{$toEmail}</strong>
                            </p>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
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