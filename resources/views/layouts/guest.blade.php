<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Thiuu Rental') }} - Authentication</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600|montserrat:700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            .font-heading { font-family: 'Montserrat', sans-serif; }
            
            
            .auth-bg {
                background: linear-gradient(135deg, rgba(0,0,0,0.9) 0%, rgba(20,20,20,0.8) 100%), 
                            url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=2070&auto=format&fit=crop');
                background-size: cover;
                background-position: center;
            }

            .glass-auth-card {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(15px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
        </style>
    </head>
    <body class="antialiased text-gray-200">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 auth-bg">
            
            <div class="auth-logo opacity-0">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 h-auto drop-shadow-2xl transition-transform hover:scale-110 duration-500">
                </a>
            </div>

            
            <div class="w-full sm:max-w-md mt-8 px-8 py-10 glass-auth-card shadow-2xl overflow-hidden sm:rounded-[2.5rem] auth-card opacity-0">
                <div class="mb-8 text-center">
                    <h2 class="font-heading text-2xl font-black text-white uppercase tracking-tighter">
                        Chào mừng bạn <span class="text-yellow-500">trở lại</span>
                    </h2>
                    <p class="text-gray-400 text-xs mt-2 italic">Trải nghiệm dịch vụ thuê xe đẳng cấp nhất</p>
                </div>

                <div class="text-gray-200">
                    {{ $slot }}
                </div>
            </div>

            
            <div class="mt-8 text-center auth-footer opacity-0">
                <a href="/" class="text-xs font-bold text-gray-400 hover:text-yellow-500 transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Quay lại trang chủ
                </a>
            </div>
        </div>

        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (window.anime) {
                    anime.timeline({
                        easing: 'easeOutExpo',
                    })
                    .add({
                        targets: '.auth-logo',
                        translateY: [20, 0],
                        opacity: [0, 1],
                        duration: 1000,
                        delay: 300
                    })
                    .add({
                        targets: '.auth-card',
                        scale: [0.95, 1],
                        opacity: [0, 1],
                        duration: 1200
                    }, '-=800')
                    .add({
                        targets: '.auth-footer',
                        translateY: [10, 0],
                        opacity: [0, 1],
                        duration: 800
                    }, '-=1000');
                }
            });
        </script>
    </body>
</html>