@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white dark:bg-black text-gray-900 dark:text-white overflow-hidden">

    {{-- Hero Section --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        {{-- Animated Background Gradient --}}
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-blue-950/20 dark:via-purple-950/20 dark:to-pink-950/20"></div>

        {{-- Floating Orbs --}}
        <div class="absolute top-20 left-20 w-72 h-72 bg-blue-500/20 dark:bg-blue-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/20 dark:bg-purple-500/10 rounded-full blur-3xl animate-float-delay"></div>

        {{-- Content --}}
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-5xl mx-auto">
                <div class="mb-8 fade-in">
                    <span class="inline-block px-6 py-3 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 text-white text-xs font-bold uppercase tracking-wider">
                        Premium Car Services
                    </span>
                </div>

                <h1 class="text-6xl md:text-8xl lg:text-9xl font-black mb-8 fade-in-up">
                    <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                        DỊCH VỤ
                    </span>
                    <br>
                    <span class="text-gray-900 dark:text-white">ĐẲNG CẤP</span>
                </h1>

                <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-400 mb-12 max-w-3xl mx-auto leading-relaxed fade-in-up-delay">
                    Trải nghiệm dịch vụ cho thuê xe cao cấp với đội ngũ chuyên nghiệp,
                    <span class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">cam kết mang đến sự hoàn hảo</span>
                    trên từng hành trình
                </p>

                <div class="flex flex-wrap gap-4 justify-center fade-in-up-delay-2">
                    <a href="{{ route('home') }}" class="group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-2xl overflow-hidden transition-all hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/50">
                        <span class="relative z-10 flex items-center gap-2">
                            Đặt xe ngay <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                    <a href="#services" class="px-8 py-4 border-2 border-gray-900 dark:border-white text-gray-900 dark:text-white font-bold rounded-2xl hover:bg-gray-900 hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">
                        Xem dịch vụ
                    </a>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce">
            <i class="fa-solid fa-chevron-down text-gray-400 text-2xl"></i>
        </div>
    </section>

    {{-- Services Grid --}}
    <section id="services" class="py-32 relative">
        <div class="container mx-auto px-4">
            <div class="text-center mb-20">
                <h2 class="text-5xl md:text-7xl font-black mb-6">
                    <span class="text-gray-900 dark:text-white">CÁC DỊCH VỤ CỦA</span>
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"> CHÚNG TÔI</span>
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">Lựa chọn hoàn hảo cho mọi nhu cầu của bạn</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                @php
                $services = [
                [
                'icon' => 'fa-car-side',
                'title' => 'Tự Lái',
                'subtitle' => 'Self Drive',
                'description' => 'Tự do khám phá với bộ sưu tập xe đời mới. Thủ tục đơn giản, giao xe nhanh chóng.',
                'features' => ['Không cần thế chấp', 'Giao xe tận nơi', 'Hỗ trợ 24/7'],
                'gradient' => 'from-blue-500 to-cyan-500',
                'iconBg' => 'bg-blue-500/10',
                'iconColor' => 'text-blue-600 dark:text-blue-400'
                ],
                [
                'icon' => 'fa-user-tie',
                'title' => 'Có Tài Xế',
                'subtitle' => 'Elite Chauffeur',
                'description' => 'Đội ngũ tài xế chuyên nghiệp, được đào tạo bài bản, phục vụ tận tâm.',
                'features' => ['Tài xế riêng', 'Kinh nghiệm lâu năm', 'Trang phục lịch sự'],
                'gradient' => 'from-purple-500 to-pink-500',
                'iconBg' => 'bg-purple-500/10',
                'iconColor' => 'text-purple-600 dark:text-purple-400'
                ],
                [
                'icon' => 'fa-gem',
                'title' => 'Sự Kiện VIP',
                'subtitle' => 'Red Carpet',
                'description' => 'Dịch vụ xe hoa, roadshow và đưa đón sự kiện đẳng cấp quốc tế.',
                'features' => ['Xe hoa sang trọng', 'Trang trí theo yêu cầu', 'Đội ngũ phục vụ'],
                'gradient' => 'from-pink-500 to-rose-500',
                'iconBg' => 'bg-pink-500/10',
                'iconColor' => 'text-pink-600 dark:text-pink-400'
                ],
                [
                'icon' => 'fa-shield-halved',
                'title' => 'Bảo Hiểm Toàn Diện',
                'subtitle' => 'Full Insurance',
                'description' => 'Bảo hiểm 100% giá trị xe, yên tâm tuyệt đối trên mọi hành trình.',
                'features' => ['Bồi thường 100%', 'Không cần đặt cọc', 'Hỗ trợ sự cố'],
                'gradient' => 'from-green-500 to-emerald-500',
                'iconBg' => 'bg-green-500/10',
                'iconColor' => 'text-green-600 dark:text-green-400'
                ],
                [
                'icon' => 'fa-clock',
                'title' => 'Thuê Theo Giờ',
                'subtitle' => 'Hourly Rental',
                'description' => 'Linh hoạt theo giờ, phù hợp cho những chuyến đi ngắn ngày trong thành phố.',
                'features' => ['Tối thiểu 4 giờ', 'Giá ưu đãi', 'Thanh toán linh hoạt'],
                'gradient' => 'from-orange-500 to-amber-500',
                'iconBg' => 'bg-orange-500/10',
                'iconColor' => 'text-orange-600 dark:text-orange-400'
                ],
                [
                'icon' => 'fa-building',
                'title' => 'Doanh Nghiệp',
                'subtitle' => 'Corporate',
                'description' => 'Giải pháp vận tải toàn diện cho doanh nghiệp, hợp đồng dài hạn ưu đãi.',
                'features' => ['Hợp đồng linh hoạt', 'Giảm giá đặc biệt', 'Quản lý tập trung'],
                'gradient' => 'from-indigo-500 to-blue-500',
                'iconBg' => 'bg-indigo-500/10',
                'iconColor' => 'text-indigo-600 dark:text-indigo-400'
                ]
                ];
                @endphp

                @foreach($services as $service)
                <div class="service-card group relative bg-white dark:bg-gray-900 rounded-3xl p-8 border border-gray-100 dark:border-gray-800 hover:border-transparent dark:hover:border-transparent transition-all duration-500 hover:shadow-2xl hover:-translate-y-2">
                    {{-- Gradient Border on Hover --}}
                    <div class="absolute -inset-0.5 bg-gradient-to-r {{ $service['gradient'] }} rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10 blur"></div>

                    {{-- Icon --}}
                    <div class="w-16 h-16 {{ $service['iconBg'] }} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid {{ $service['icon'] }} text-3xl {{ $service['iconColor'] }}"></i>
                    </div>

                    {{-- Title --}}
                    <div class="mb-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">{{ $service['subtitle'] }}</p>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white">{{ $service['title'] }}</h3>
                    </div>

                    {{-- Description --}}
                    <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">{{ $service['description'] }}</p>

                    {{-- Features --}}
                    <ul class="space-y-2 mb-6">
                        @foreach($service['features'] as $feature)
                        <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>

                    {{-- CTA Button --}}
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-bold bg-gradient-to-r {{ $service['gradient'] }} text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all group-hover:gap-3">
                        Đặt ngay <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section class="py-32 bg-gray-50 dark:bg-gray-900/50 relative overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    {{-- Image Side --}}
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl blur-2xl opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1560179707-f14e90ef3623?q=80&w=2073"
                            alt="Luxury Car"
                            class="relative rounded-3xl shadow-2xl w-full"
                            onerror="this.src='https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=2000'">
                    </div>

                    {{-- Content Side --}}
                    <div>
                        <h2 class="text-5xl md:text-6xl font-black mb-8">
                            <span class="text-gray-900 dark:text-white">TẠI SAO CHỌN</span><br>
                            <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">THIUU RENTAL?</span>
                        </h2>

                        <div class="space-y-6">
                            @php
                            $reasons = [
                            ['icon' => 'fa-star', 'title' => 'Dịch vụ 5 sao', 'desc' => 'Đội ngũ chuyên nghiệp, phục vụ tận tâm 24/7'],
                            ['icon' => 'fa-shield-check', 'title' => 'An toàn tuyệt đối', 'desc' => 'Bảo hiểm toàn diện, xe được bảo dưỡng định kỳ'],
                            ['icon' => 'fa-hand-holding-dollar', 'title' => 'Giá cả minh bạch', 'desc' => 'Không phí ẩn, cam kết giá tốt nhất thị trường'],
                            ['icon' => 'fa-car', 'title' => 'Đa dạng xe', 'desc' => 'Hơn 100+ mẫu xe từ phổ thông đến cao cấp'],
                            ];
                            @endphp

                            @foreach($reasons as $reason)
                            <div class="flex gap-4 items-start p-6 rounded-2xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:border-purple-500 dark:hover:border-purple-500 transition-all group">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid {{ $reason['icon'] }} text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-1">{{ $reason['title'] }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $reason['desc'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Process Section --}}
    <section class="py-32">
        <div class="container mx-auto px-4">
            <div class="text-center mb-20">
                <h2 class="text-5xl md:text-7xl font-black mb-6">
                    <span class="text-gray-900 dark:text-white">QUY TRÌNH</span>
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"> ĐƠN GIẢN</span>
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">Chỉ 4 bước để sở hữu xế yêu</p>
            </div>

            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                    {{-- Connecting Line --}}
                    <div class="hidden md:block absolute top-12 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600"></div>

                    @php
                    $steps = [
                    ['num' => '01', 'title' => 'Chọn Xe', 'desc' => 'Tìm xe phù hợp trên website', 'color' => 'blue'],
                    ['num' => '02', 'title' => 'Đặt Cọc', 'desc' => 'Thanh toán cọc online hoặc chuyển khoản', 'color' => 'purple'],
                    ['num' => '03', 'title' => 'Nhận Xe', 'desc' => 'Ký hợp đồng và nhận xe tại địa điểm', 'color' => 'pink'],
                    ['num' => '04', 'title' => 'Trả Xe', 'desc' => 'Hoàn tất hợp đồng và nhận lại cọc', 'color' => 'rose'],
                    ];
                    @endphp

                    @foreach($steps as $step)
                    <div class="text-center relative z-10 process-step">
                        <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-{{ $step['color'] }}-500 to-{{ $step['color'] }}-600 flex items-center justify-center text-white font-black text-2xl shadow-lg hover:scale-110 transition-transform">
                            {{ $step['num'] }}
                        </div>
                        <h4 class="font-bold text-lg mb-2 text-gray-900 dark:text-white">{{ $step['title'] }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $step['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center text-white max-w-4xl mx-auto">
                <h2 class="text-5xl md:text-7xl font-black mb-8">
                    SẴN SÀNG KHỞI HÀNH?
                </h2>
                <p class="text-xl md:text-2xl mb-12 opacity-90">
                    Hàng trăm khách hàng đã tin tưởng. Đến lượt bạn trải nghiệm dịch vụ đẳng cấp!
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('home') }}" class="px-10 py-5 bg-white text-purple-600 font-bold rounded-2xl hover:scale-105 transition-all shadow-2xl hover:shadow-white/50">
                        Đặt xe ngay
                    </a>
                    <a href="https://zalo.me/0123456789" class="px-10 py-5 border-2 border-white text-white font-bold rounded-2xl hover:bg-white hover:text-purple-600 transition-all">
                        Liên hệ tư vấn
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-20px) rotate(5deg);
        }
    }

    @keyframes float-delay {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-30px) rotate(-5deg);
        }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-float-delay {
        animation: float-delay 8s ease-in-out infinite;
    }

    .fade-in {
        animation: fadeIn 1s ease-out;
    }

    .fade-in-up {
        animation: fadeInUp 1s ease-out 0.2s backwards;
    }

    .fade-in-up-delay {
        animation: fadeInUp 1s ease-out 0.4s backwards;
    }

    .fade-in-up-delay-2 {
        animation: fadeInUp 1s ease-out 0.6s backwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .service-card {
        animation: fadeInUp 0.8s ease-out backwards;
    }

    .service-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .service-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .service-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .service-card:nth-child(4) {
        animation-delay: 0.4s;
    }

    .service-card:nth-child(5) {
        animation-delay: 0.5s;
    }

    .service-card:nth-child(6) {
        animation-delay: 0.6s;
    }

    .process-step {
        animation: fadeInUp 0.8s ease-out backwards;
    }

    .process-step:nth-child(2) {
        animation-delay: 0.1s;
    }

    .process-step:nth-child(3) {
        animation-delay: 0.2s;
    }

    .process-step:nth-child(4) {
        animation-delay: 0.3s;
    }

    .process-step:nth-child(5) {
        animation-delay: 0.4s;
    }
</style>
@endsection