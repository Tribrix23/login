<?php
include __DIR__ . "/../config/config.php";

if (isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resend Verification - Project Web</title>
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
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-4">Resend Verification</h2>
            <p class="text-indigo-100 text-lg">Enter your email address and we'll resend the verification link.</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            <div class="text-center lg:text-left mb-8">
                <a href="../index.php" class="inline-flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Project Web</span>
                </a>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Resend Verification Email</h1>
                <p class="text-gray-600">Enter your registered email to resend the verification link.</p>
            </div>

            <form class="space-y-5" id="resendForm">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="name@example.com" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all">
                </div>

                <div id="message" class="hidden p-4 rounded-xl"></div>

                <button type="submit"
                    class="w-full gradient-bg text-white py-3 rounded-xl font-semibold hover:opacity-90 transition-opacity shadow-lg shadow-indigo-500/25">
                    Send Verification Email
                </button>
            </form>

            <div class="mt-8 text-center">
                <p onclick="route('login')" class="cursor-pointer text-gray-600">Remember your password? <a
                        class="text-indigo-600 hover:text-indigo-700 font-medium">Sign in</a></p>
            </div>
        </div>
    </div>

    <script src="assets/js/app.js"></script>
    <script>
        document.getElementById('resendForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const messageEl = document.getElementById('message');
            const btn = e.target.querySelector('button');

            btn.disabled = true;
            btn.textContent = 'Sending...';

            try {
                const res = await fetch("../lib/handler/resendVerifyHandler.php", {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email })
                });
                const data = await res.json();
                
                messageEl.classList.remove('hidden');
                if (data.success) {
                    messageEl.className = 'p-4 rounded-xl bg-green-50 text-green-700 border border-green-200';
                    messageEl.textContent = data.message;
                } else {
                    messageEl.className = 'p-4 rounded-xl bg-red-50 text-red-700 border border-red-200';
                    messageEl.textContent = data.message;
                }
            } catch (err) {
                messageEl.classList.remove('hidden');
                messageEl.className = 'p-4 rounded-xl bg-red-50 text-red-700 border border-red-200';
                messageEl.textContent = 'An error occurred. Please try again.';
            }
            
            btn.disabled = false;
            btn.textContent = 'Send Verification Email';
        });
    </script>
</body>

</html>