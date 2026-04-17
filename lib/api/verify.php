<?php
require_once __DIR__ . "/../database/db.php";

$token = $_GET["token"] ?? '';

if (!$token) {
    header('Location: ../../index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT user_id, expires_at FROM email_verifications WHERE token = ? LIMIT 1');
$stmt->execute([$token]);

$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    header('Location: ../../index.php');
    exit;
}

if (strtotime($record['expires_at']) < time()) {
    $pdo->prepare('DELETE FROM email_verifications WHERE token = ?')
        ->execute([$token]);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Link Expired - Project Web</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }

            .gradient-text {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .gradient-bg {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            }
        </style>
    </head>

    <body class="bg-gray-50 min-h-screen flex">
        <div class="hidden lg:flex lg:w-1/2 gradient-bg items-center justify-center p-12 relative overflow-hidden">
            <div class="absolute inset-0 -z-10">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>
            </div>
            <div class="max-w-md text-center">
                <div
                    class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-8 backdrop-blur-sm">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-white mb-4">Link Expired</h2>
                <p class="text-indigo-100 text-lg">Your verification link has expired.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md text-center">
                <a href="../index.php" class="inline-flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Project Web</span>
                </a>

                <div class="bg-red-50 border border-red-200 rounded-2xl p-8 mb-8">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Verification Link Expired</h1>
                    <p class="text-gray-600">This verification link has expired. Please request a new one.</p>
                </div>
            </div>
        </div>

    </body>

    </html>

    <?php
    exit;
}

$stmt = $pdo->prepare('UPDATE users SET is_active = 1, email_verified = 1 WHERE id = ?');
$stmt->execute([$record['user_id']]);

$stmt = $pdo->prepare('DELETE FROM email_verifications WHERE token = ?');
$stmt->execute([$token]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verified - Project Web</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex">
    <div class="hidden lg:flex lg:w-1/2 gradient-bg items-center justify-center p-12 relative overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>
        </div>
        <div class="max-w-md text-center">
            <div
                class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-8 backdrop-blur-sm">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-4">Email Verified</h2>
            <p class="text-indigo-100 text-lg">Your account has been successfully verified.</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md text-center">
            <a href="../index.php" class="inline-flex items-center gap-2 mb-6">
                <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-900">Project Web</span>
            </a>

            <div class="bg-green-50 border border-green-200 rounded-2xl p-8 mb-8">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Email Verified!</h1>
                <p class="text-gray-600">Your account is now active. You can sign in to your account.</p>
            </div>

            <p onclick="route('login')"
                class="cursor-pointer inline-block w-full gradient-bg text-white py-3 rounded-xl font-semibold hover:opacity-90 transition-opacity shadow-lg shadow-indigo-500/25">
                Go to Login
            </p>
        </div>
    </div>

    <script src="../../assets/js/app.js"></script>
</body>

</html>