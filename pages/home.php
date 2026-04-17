<?php
include __DIR__ . "/../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Project Web</title>
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
                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-4">Dashboard</h2>
            <p class="text-indigo-100 text-lg">Welcome to your personal dashboard. Manage your account and settings
                here.
            </p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col">
        <div class="flex-1 flex items-center justify-center p-8">
            <div class="w-full max-w-md text-center">
                <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome back,</h1>
                <p class="text-2xl font-bold gradient-text mb-8" id="userName"></p>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500">Profile</p>
                        <p class="font-semibold text-gray-900">Complete</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="font-semibold text-gray-900">Active</p>
                    </div>
                </div>

                <button type="button" id="logoutBtn"
                    class="cursor-pointer w-full bg-white border-2 border-red-500 text-red-600 py-3 rounded-xl font-semibold hover:bg-red-50 transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </div>
        </div>

        <div class="bg-white border-t border-gray-100 p-4">
            <div class="max-w-md mx-auto flex items-center justify-between">
                <a href="../index.php" class="inline-flex items-center gap-2">
                    <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Project Web</span>
                </a>
                <p class="text-sm text-gray-500">&copy; 2026 All rights reserved.</p>
            </div>
        </div>
    </div>

    <div id="toast-container" class="fixed top-4 right-4 z-50"></div>

    <script src="assets/js/script.js"></script>
    <script>
        document.getElementById('logoutBtn').addEventListener('click', async () => {
            try {
                const res = await fetch("proxy.php?page=logout", {
                    method: 'POST',
                    credentials: 'include'
                });

                const data = await res.json();

                if (data.success) {
                    window.location.href = './';
                }
            } catch (err) {
            }
        });
    </script>
</body>

</html>