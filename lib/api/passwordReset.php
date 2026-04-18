<?php
require_once __DIR__ . "/../database/db.php";

$token = $_GET["token"] ?? '';

if (!$token) {
    header('Location: ../../index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT user_id, expires_at FROM password_resets WHERE token = ? LIMIT 1');
$stmt->execute([$token]);

$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    // Invalid token - show error page (similar to verify.php expired)
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invalid Reset Link - Project Web</title>
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
                <h2 class="text-3xl font-bold text-white mb-4">Invalid Reset Link</h2>
                <p class="text-indigo-100 text-lg">This password reset link is invalid or has already been used.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md text-center">
                <a href="../../index.php" class="inline-flex items-center gap-2 mb-6">
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
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Invalid Reset Link</h1>
                    <p class="text-gray-600">This password reset link is invalid or has already been used.</p>
                </div>

                <script src="../../assets/js/app.js"></script>
                <p onclick="routeF('forgotPassword')"
                    class="cursor-pointer inline-block w-full gradient-bg text-white py-3 rounded-xl font-semibold hover:opacity-90 transition-opacity shadow-lg shadow-indigo-500/25">
                    Request New Link
                </p>
            </div>
        </div>

    </body>

    </html>
    <?php
    exit;
}

if (strtotime($record['expires_at']) < time()) {
    $pdo->prepare('DELETE FROM password_resets WHERE token = ?')->execute([$token]);
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
                <p class="text-indigo-100 text-lg">Your password reset link has expired. Please request a new one.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md text-center">
                <a href="../../index.php" class="inline-flex items-center gap-2 mb-6">
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
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Reset Link Expired</h1>
                    <p class="text-gray-600">Your password reset link has expired. Please request a new one.</p>
                </div>

                <script src="../../assets/js/app.js"></script>
                <p onclick="routeF('forgotPassword')"
                    class="cursor-pointer inline-block w-full gradient-bg text-white py-3 rounded-xl font-semibold hover:opacity-90 transition-opacity shadow-lg shadow-indigo-500/25">
                    Request New Link
                </p>
            </div>
        </div>

    </body>

    </html>
    <?php
    exit;
}

// Token is valid - show password reset form
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Project Web</title>
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

        .password-strength-bar {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex">
    <!-- Left Side - Gradient Background (Hidden on mobile) -->
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
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-4">Create New Password</h2>
            <p class="text-indigo-100 text-lg">Your new password must be different from previously used passwords.</p>
        </div>
    </div>

    <!-- Right Side - Form Content -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="text-center lg:text-left mb-8">
                <a href="../../index.php" class="inline-flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Project Web</span>
                </a>

                <div class="text-center lg:text-left mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Reset Password</h1>
                    <p class="text-gray-600">Enter your new password below.</p>
                </div>

                <form id="resetPasswordForm" method="POST" class="space-y-5">
                    <input type="hidden" id="token" name="token" value="<?php echo htmlspecialchars($token); ?>">

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Enter new password"
                                required
                                class="w-full px-4 py-3 pr-12 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all">
                            <button type="button" onclick="togglePassword('password', 'togglePasswordBtn')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <span id="togglePasswordBtn">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <!-- Password Strength Indicator -->
                        <div id="passwordStrength" class="mt-2 hidden">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-500">Strength:</span>
                                <span id="strengthText" class="font-medium"></span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1 overflow-hidden">
                                <div id="strengthBar" class="password-strength-bar w-0"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirm New
                            Password</label>
                        <div class="relative">
                            <input type="password" id="confirm_password" name="confirm_password"
                                placeholder="Confirm new password" required
                                class="w-full px-4 py-3 pr-12 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all">
                            <button type="button"
                                onclick="togglePassword('confirm_password', 'toggleConfirmPasswordBtn')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <span id="toggleConfirmPasswordBtn">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <!-- Password Match Indicator -->
                        <p id="passwordMatch" class="hidden text-red-500 text-sm mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Passwords do not match
                        </p>
                    </div>

                    <button type="submit"
                        class="w-full gradient-bg text-white py-3 rounded-xl font-semibold hover:opacity-90 transition-opacity shadow-lg shadow-indigo-500/25">
                        Reset Password
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p onclick="goLoginF()" class="cursor-pointer text-gray-600">
                        Remember your password? <a class="text-indigo-600 hover:text-indigo-700 font-medium">Sign in</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Toast Container -->
        <div id="toast-container" class="fixed top-4 right-4 z-50 flex flex-col gap-2"></div>

        <script src="../../assets/js/app.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const resetForm = document.getElementById('resetPasswordForm');
                const passwordInput = document.getElementById('password');
                const confirmInput = document.getElementById('confirm_password');
                const passwordMatch = document.getElementById('passwordMatch');
                const strengthDiv = document.getElementById('passwordStrength');
                const strengthBar = document.getElementById('strengthBar');
                const strengthText = document.getElementById('strengthText');

                // Password strength checker
                passwordInput.addEventListener('input', function () {
                    const password = passwordInput.value;
                    if (password.length > 0) {
                        strengthDiv.classList.remove('hidden');
                        const strength = calculateStrength(password);
                        updateStrengthIndicator(strength);
                    } else {
                        strengthDiv.classList.add('hidden');
                    }
                });

                // Password match checker
                confirmInput.addEventListener('input', function () {
                    if (confirmInput.value !== passwordInput.value) {
                        passwordMatch.classList.remove('hidden');
                    } else {
                        passwordMatch.classList.add('hidden');
                    }
                });

                // Form submission
                resetForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const password = passwordInput.value;
                    const confirm = confirmInput.value;
                    const token = document.getElementById('token').value;

                    // Validation
                    if (password !== confirm) {
                        showToast('Passwords do not match', 'error');
                        return;
                    }

                    if (password.length < 8) {
                        showToast('Password must be at least 8 characters', 'error');
                        return;
                    }

                    showLoading();
                    const submitBtn = resetForm.querySelector('button[type="submit"]');
                    setButtonLoading(submitBtn, true);

                    try {
                        const res = await fetch("../../proxy.php?page=resetPassword", {
                            method: 'POST',
                            credentials: 'include',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                token: token,
                                password: password
                            })
                        });

                        const text = await res.text();
                        let data;
                        try {
                            data = JSON.parse(text);
                        } catch (e) {
                            data = { success: false, message: 'Invalid response from server' };
                        }

                        if (data.success) {
                            showToast('✓ Password reset successfully', 'success');
                            setTimeout(() => {
                                window.location.href = '../../';
                            }, 2000);
                        } else {
                            showToast('✗ ' + (data.message || 'Password reset failed'), 'error');
                        }
                    } catch (err) {
                        showToast('Network error. Please try again.', 'error');
                    } finally {
                        hideLoading();
                        setButtonLoading(submitBtn, false);
                    }
                });

                function calculateStrength(password) {
                    let score = 0;
                    if (password.length >= 8) score++;
                    if (password.length >= 12) score++;
                    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
                    if (/\d/.test(password)) score++;
                    if (/[^a-zA-Z0-9]/.test(password)) score++;

                    if (score <= 2) return { level: 'weak', color: 'bg-red-500', width: '33%', text: 'Weak' };
                    if (score <= 3) return { level: 'fair', color: 'bg-yellow-500', width: '66%', text: 'Fair' };
                    if (score <= 4) return { level: 'good', color: 'bg-blue-500', width: '80%', text: 'Good' };
                    return { level: 'strong', color: 'bg-green-500', width: '100%', text: 'Strong' };
                }

                function updateStrengthIndicator(strength) {
                    strengthBar.className = `password-strength-bar ${strength.color} w-${strength.width}`;
                    strengthText.textContent = strength.text;
                    strengthText.className = strength.level === 'weak' ? 'font-medium text-red-500' :
                        strength.level === 'fair' ? 'font-medium text-yellow-500' :
                            strength.level === 'good' ? 'font-medium text-blue-500' : 'font-medium text-green-500';
                }
            });
        </script>
</body>

</html>
<?php
exit;
?>