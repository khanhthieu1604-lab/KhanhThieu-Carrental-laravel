<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thiuu Ecosystem - Dịch Vụ Cao Cấp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        .font-display {
            font-family: 'Playfair Display', serif;
        }

        .font-sans {
            font-family: 'Inter', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
        }

        .gradient-gold {
            background: linear-gradient(135deg, #D4A574 0%, #B8860B 50%, #D4A574 100%);
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen font-sans">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 gradient-gold rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-lg">T</span>
                </div>
                <span class="text-white font-display text-xl font-semibold">Thiuu Ecosystem</span>
            </div>

            @auth
            <div class="flex items-center space-x-4">
                <span class="text-white/70">Xin chào, <span class="text-amber-400">{{ auth()->user()->name }}</span></span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-white/70 hover:text-white transition">Đăng xuất</button>
                </form>
            </div>
            @else
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-white/70 hover:text-white transition">Đăng nhập</a>
                <a href="{{ route('register') }}" class="gradient-gold text-white px-4 py-2 rounded-full text-sm font-medium">Đăng ký</a>
            </div>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="font-display text-5xl md:text-7xl text-white font-bold mb-6">
                Hệ Sinh Thái <span class="text-transparent bg-clip-text gradient-gold">Thiuu</span>
            </h1>
            <p class="text-white/60 text-lg md:text-xl max-w-2xl mx-auto mb-12">
                Trải nghiệm dịch vụ cao cấp từ thuê xe sang trọng đến nghỉ dưỡng khách sạn 5 sao.
                Một tài khoản - Mọi dịch vụ.
            </p>

            <!-- SSO Badge -->
            <div class="inline-flex items-center glass px-6 py-3 rounded-full border border-amber-500/30 mb-16">
                <svg class="w-5 h-5 text-amber-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-amber-400 font-medium">Single Sign-On • Đăng nhập 1 lần, sử dụng mọi nơi</span>
            </div>
        </div>
    </section>

    <!-- Services Cards -->
    <section class="px-6 pb-20">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8">

            <!-- Car Rental Card -->
            <a href="{{ $carRentalUrl }}" class="group hover-lift">
                <div class="glass rounded-3xl overflow-hidden border border-white/10 h-full">
                    <div class="relative h-64 bg-gradient-to-br from-amber-500/20 to-orange-600/20 flex items-center justify-center">
                        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800')] bg-cover bg-center opacity-30"></div>
                        <svg class="w-24 h-24 text-amber-400 relative z-10 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 17a2 2 0 100-4 2 2 0 000 4zm8 0a2 2 0 100-4 2 2 0 000 4zM5 13h14l-3-6H8l-3 6z" />
                        </svg>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-display text-2xl text-white font-semibold">Thiuu CarRental</h3>
                            <span class="text-xs uppercase tracking-wider text-amber-400 bg-amber-400/10 px-3 py-1 rounded-full">Siêu Xe</span>
                        </div>
                        <p class="text-white/60 mb-6">
                            Trải nghiệm cảm giác lái những siêu xe đẳng cấp thế giới.
                            Lamborghini, Ferrari, Rolls-Royce - Tự lái hoặc tài xế VIP.
                        </p>
                        <div class="flex items-center text-amber-400 font-medium group-hover:translate-x-2 transition-transform">
                            <span>Khám phá ngay</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Hotel Card -->
            <a href="{{ $hotelUrl }}" class="group hover-lift">
                <div class="glass rounded-3xl overflow-hidden border border-white/10 h-full">
                    <div class="relative h-64 bg-gradient-to-br from-emerald-500/20 to-teal-600/20 flex items-center justify-center">
                        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800')] bg-cover bg-center opacity-30"></div>
                        <svg class="w-24 h-24 text-emerald-400 relative z-10 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-display text-2xl text-white font-semibold">KThiuu Hotel</h3>
                            <span class="text-xs uppercase tracking-wider text-emerald-400 bg-emerald-400/10 px-3 py-1 rounded-full">5 Sao</span>
                        </div>
                        <p class="text-white/60 mb-6">
                            Nghỉ dưỡng đẳng cấp tại khách sạn 5 sao sang trọng.
                            View biển tuyệt đẹp, dịch vụ spa cao cấp, ẩm thực tinh tế.
                        </p>
                        <div class="flex items-center text-emerald-400 font-medium group-hover:translate-x-2 transition-transform">
                            <span>Đặt phòng ngay</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="px-6 pb-20">
        <div class="max-w-4xl mx-auto">
            <h2 class="font-display text-3xl text-white text-center font-semibold mb-12">Lợi Ích Hệ Sinh Thái</h2>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="glass rounded-2xl p-6 border border-white/10 text-center">
                    <div class="w-14 h-14 gradient-gold rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Đăng Nhập Một Lần</h3>
                    <p class="text-white/60 text-sm">Dùng cùng tài khoản cho cả thuê xe và đặt phòng khách sạn</p>
                </div>

                <div class="glass rounded-2xl p-6 border border-white/10 text-center">
                    <div class="w-14 h-14 gradient-gold rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Ưu Đãi Combo</h3>
                    <p class="text-white/60 text-sm">Giảm giá khi sử dụng cả hai dịch vụ cùng lúc</p>
                </div>

                <div class="glass rounded-2xl p-6 border border-white/10 text-center">
                    <div class="w-14 h-14 gradient-gold rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Điểm Thưởng Chung</h3>
                    <p class="text-white/60 text-sm">Tích lũy và sử dụng điểm thưởng xuyên suốt</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-white/10 py-8 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
            <p class="text-white/40 text-sm">© 2026 Thiuu Ecosystem. All rights reserved.</p>
            <div class="flex items-center space-x-6 mt-4 md:mt-0">
                <a href="{{ $carRentalUrl }}" class="text-white/40 hover:text-amber-400 transition text-sm">CarRental</a>
                <a href="{{ $hotelUrl }}" class="text-white/40 hover:text-emerald-400 transition text-sm">Hotel</a>
            </div>
        </div>
    </footer>

</body>

</html>