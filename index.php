<?php
include "config/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
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

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -12px rgba(99, 102, 241, 0.25);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <header class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-lg shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center justify-between h-16">
                <a href="index.php" class="flex items-center gap-2">
                    <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900"><?php echo SITE_NAME; ?></span>
                </a>
                <div class="flex items-center gap-3">
                    <button onclick="route('login')"
                        class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded-lg font-medium transition-colors cursor-pointer">Sign
                        In</button>
                    <button onclick="route('register')"
                        class="gradient-bg text-white px-4 py-2 rounded-lg font-medium hover:opacity-90 transition-opacity cursor-pointer">Get
                        Started</button>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <section class="pt-32 pb-20 relative overflow-hidden">
            <div class="absolute inset-0 -z-10">
                <div
                    class="absolute top-20 left-10 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob">
                </div>
                <div
                    class="absolute top-20 right-10 w-72 h-72 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000">
                </div>
                <div
                    class="absolute -bottom-8 left-1/2 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000">
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm mb-6">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-sm text-gray-600">Now with enhanced security</span>
                </div>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-gray-900 mb-6 leading-tight">
                    Secure Authentication<br>
                    <span class="gradient-text">Made Simple</span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 mb-10 max-w-2xl mx-auto">Protect your applications with
                    enterprise-grade security. Fast, reliable, and easy to integrate authentication system.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="route('register')"
                        class="gradient-bg cursor-pointer text-white px-8 py-4 rounded-xl text-lg font-semibold hover:opacity-90 transition-opacity shadow-lg shadow-indigo-500/25">Create
                        Free Account</button>
                    <button onclick="route('login')"
                        class="bg-white text-gray-700 border-2 border-gray-200 px-8 py-4 rounded-xl text-lg font-semibold hover:border-gray-300 transition-colors cursor-pointer">Sign
                        In</button>
                </div>
            </div>
        </section>

        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-4">Why Choose <?php echo SITE_NAME; ?>?</h2>
                <p class="text-center text-gray-500 mb-12 max-w-xl mx-auto">Everything you need to secure your
                    applications</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card-hover bg-gray-50 p-8 rounded-2xl">
                        <div class="w-14 h-14 gradient-bg rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Bank-Level Security</h3>
                        <p class="text-gray-600">Industry-leading encryption keeps your data safe with end-to-end
                            protection.</p>
                    </div>
                    <div class="card-hover bg-gray-50 p-8 rounded-2xl">
                        <div class="w-14 h-14 gradient-bg rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Lightning Fast</h3>
                        <p class="text-gray-600">Optimized for speed with sub-100ms response times for seamless
                            experience.</p>
                    </div>
                    <div class="card-hover bg-gray-50 p-8 rounded-2xl">
                        <div class="w-14 h-14 gradient-bg rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">99.9% Uptime</h3>
                        <p class="text-gray-600">Enterprise infrastructure ensures your auth is always available when
                            you need it.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 gradient-bg relative overflow-hidden">
            <div class="absolute inset-0 -z-10">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to get started?</h2>
                <p class="text-indigo-100 mb-8 text-lg">Join thousands of developers securing their apps</p>
                <button onclick="route('register')"
                    class="inline-block bg-white cursor-pointer text-indigo-600 px-8 py-4 rounded-xl text-lg font-semibold hover:bg-gray-100 transition-colors shadow-lg">Create
                    Free Account</button>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
        </div>
    </footer>

    <script src="assets/js/app.js"></script>
</body>

</html>