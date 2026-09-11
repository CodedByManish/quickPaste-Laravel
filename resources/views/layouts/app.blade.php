<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'QuickPaste - Fast & Secure Text Sharing' }}</title>
    <meta name="description" content="{{ $pageDescription ?? 'Share text, files, or URLs quickly and securely.' }}">
    <meta name="keywords" content="quick paste, text sharing, file upload, URL shortener, developer tool, paste code online, private text sharing">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph & Twitter -->
    <meta property="og:title" content="{{ $pageTitle ?? 'QuickPaste - Fast & Secure Text Sharing' }}">
    <meta property="og:description" content="{{ $pageDescription ?? 'Share notes, files, or links instantly.' }}">
    <meta property="og:image" content="{{ asset('assets/images/og-image.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle ?? 'QuickPaste - Share Instantly' }}">
    <meta name="twitter:description" content="{{ $pageDescription ?? 'Fast and secure paste sharing with no login required.' }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles & Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}" type="image/png">

    <!-- Schema JSON-LD -->
    <script type="application/ld+json">
    @verbatim
            {
                "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "QuickPaste"
    }
        @endverbatim
    </script>
</head>
<body class="bg-gray-900 transition-colors duration-300 flex flex-col min-h-screen relative overflow-x-hidden">

<!-- Background Particles Container -->
<div class="particles-container absolute inset-0 pointer-events-none z-0"></div>

<!-- Header -->
<header class="bg-gray-800 shadow-md sticky top-0 z-20">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('assets/images/logo.png') }}" alt="QuickPaste Logo" class="h-10 mr-2" onerror="this.style.display='none'">
            <h1 class="text-2xl font-bold text-blue-400">Quick<span class="text-gray-300">Paste</span></h1>
        </a>
    </div>
</header>

<!-- Main Content -->
<main class="container mx-auto px-4 py-8 flex-grow relative z-10">
    @yield('content')
</main>

<!-- Footer -->
<footer class="glassmorphism text-gray-400 shadow-inner py-8 mt-12 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Info -->
            <div>
                <div class="flex items-center mb-4 gap-4">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="QuickPaste Logo" class="h-11 w-11" onerror="this.style.display='none'">
                    <h1 class="text-2xl font-bold">
                        <span class="text-blue-400">Quick</span><span class="text-gray-300">Paste</span>
                    </h1>
                </div>
                <p class="text-sm">
                    A fast and minimalist way to share code snippets.<br>
                    Secure, lightweight, and built for developers by developers.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-white text-sm font-semibold mb-4 text-blue-400">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition-colors">About</a></li>
                    <li><a href="{{ route('privacy') }}" class="hover:text-blue-400 transition-colors">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-blue-400 transition-colors">Terms of Service</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Connect -->
            <div>
                <h3 class="text-white text-sm font-semibold mb-4 text-blue-400">Connect</h3>
                <div class="flex space-x-6 text-lg">
                    <a href="mailto:quickpaste.com.in" title="Email" class="hover:text-blue-400 transition-colors">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a href="https://discord.com/channels/1380248100689547274/1380248101146591246" target="_blank" rel="noopener" title="Discord" class="hover:text-blue-400 transition-colors">
                        <i class="fab fa-discord"></i>
                    </a>
                    <a href="https://linkedin.com" target="_blank" rel="noopener" title="LinkedIn" class="hover:text-blue-400 transition-colors">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-10 border-t border-gray-700 pt-6 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} QuickPaste. All rights reserved.
        </div>
    </div>
</footer>

<!-- Audio Effects -->
<audio id="success-sound" src="{{ asset('assets/sounds/success.mp3') }}" preload="auto"></audio>

<!-- JS Scripts -->
<script src="{{ asset('js/visual-effects.js') }}"></script>
<script src="{{ asset('js/ui-handle.js') }}"></script>
<script src="{{ asset('js/submission.js') }}"></script>
</body>
</html>
