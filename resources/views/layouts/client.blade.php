<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Thiuu Rental') }} - Luxury Experience</title>
    
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">
    
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:700,900&display=swap" rel="stylesheet" />
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Instrument Sans', 'sans-serif'],
                            serif: ['Playfair Display', 'serif'],
                        },
                        colors: {
                            gold: { 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706' },
                            dark: { 950: '#070707', 900: '#0f0f0f', 800: '#1a1a1a' }
                        }
                    }
                }
            }
        </script>
    @endif
    
    <style>
        
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #070707; }
        ::-webkit-scrollbar-thumb { background: #222; border-radius: 10px; transition: 0.3s; }
        ::-webkit-scrollbar-thumb:hover { background: #f59e0b; }

        
        .font-serif { font-family: 'Playfair Display', serif; }
        
        
        .text-gradient-gold {
            background: linear-gradient(135deg, #fcd34d 0%, #d97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        
        .reveal-content { opacity: 0; transform: translateY(20px); }
        
        
        .glass-header {
            background: rgba(7, 7, 7, 0.75);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }
    </style>
</head>
<body class="bg-[#070707] text-gray-400 antialiased flex flex-col min-h-screen selection:bg-gold-500 selection:text-black">

    
    <header class="fixed top-0 w-full z-[100] transition-all duration-500 border-b border-white/5 glass-header">
        @include('layouts.partials.header')
    </header>

    
    <main class="flex-grow pt-20 reveal-content" id="main-reveal">
        @yield('content')
    </main>

    
    <footer class="bg-dark-950 border-t border-white/5 pt-20 pb-10 mt-20">
        @include('layouts.partials.footer')
    </footer>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            anime({
                targets: '#main-reveal',
                opacity: [0, 1],
                translateY: [20, 0],
                easing: 'easeOutQuart',
                duration: 1200,
                delay: 200
            });

            
            window.addEventListener('scroll', function() {
                const header = document.querySelector('header');
                if (window.scrollY > 50) {
                    header.classList.add('py-1', 'shadow-2xl');
                } else {
                    header.classList.remove('py-1', 'shadow-2xl');
                }
            });
        });
    </script>

</body>
</html>