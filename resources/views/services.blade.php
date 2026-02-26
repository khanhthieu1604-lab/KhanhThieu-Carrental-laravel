@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white">

    {{-- Hero Section --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-gray-900 via-black to-gray-900">
        {{-- Floating Orbs --}}
        <div class="absolute top-20 left-20 w-72 h-72 bg-blue-600/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-cyan-600/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        {{-- Content --}}
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-5xl mx-auto">
                <div class="mb-8 animate-fade-in-up">
                    <span class="inline-block px-6 py-3 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white text-xs font-bold uppercase tracking-wider">
                        Premium Car Services
                    </span>
                </div>

                <h1 class="text-6xl md:text-8xl lg:text-9xl font-black mb-8 animate-fade-in-up" style="animation-delay: 0.1s;">
                    <span class="bg-gradient-to-r from-blue-500 via-cyan-500 to-pink-500 bg-clip-text text-transparent">
                        DỊCH VỤ
                    </span>
                    <br>
                    <span class="text-white">ĐẲNG CẤP</span>
                </h1>

                <p class="text-xl md:text-2xl text-gray-400 mb-12 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.2s;">
                    Trải nghiệm dịch vụ cho thuê xe cao cấp với đội ngũ chuyên nghiệp,
                    <span class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">cam kết mang đến sự hoàn hảo</span>
                    trên từng hành trình
                </p>

                <div class="flex flex-wrap gap-4 justify-center animate-fade-in-up" style="animation-delay: 0.3s;">
                    <a href="#services" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold rounded-xl hover:scale-105 transition-all">
                        Xem Dịch Vụ
                    </a>
                    <a href="{{ route('home') }}" class="px-8 py-4 border-2 border-white/20 text-white font-bold rounded-xl hover:bg-white/10 transition-all">
                        Đặt Xe Ngay
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Services Grid - Modern Dark Cards --}}
    <section id="services" class="py-20 bg-black">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-5xl md:text-6xl font-black mb-6">
                    <span class="text-white">CÁC DỊCH VỤ CỦA </span>
                    <span class="bg-gradient-to-r from-blue-500 to-cyan-500 bg-clip-text text-transparent">CHÚNG TÔI</span>
                </h2>
                <p class="text-xl text-gray-400">Lựa chọn hoàn hảo cho mọi nhu cầu của bạn</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
                {{-- 1. Tự Lái - Blue --}}
                <div class="group relative bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-700 hover:border-blue-500/50 transition-all duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-car-side text-2xl text-white"></i>
                    </div>
                    <div class="mb-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">SELF DRIVE</p>
                        <h3 class="text-2xl font-black text-white">Tự Lái</h3>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">Tự do khám phá với bộ sưu tập xe đời mới. Thủ tục đơn giản, giao xa nhanh chóng.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Không cần thế chấp
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Giao xe tận nơi
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Hỗ trợ 24/7
                        </li>
                    </ul>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all w-full justify-center text-sm">
                        Đặt ngay <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="group relative bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-700 hover:border-cyan-500/50 transition-all duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-cyan-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-user-tie text-2xl text-white"></i>
                    </div>
                    <div class="mb-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">ELITE CHAUFFEUR</p>
                        <h3 class="text-2xl font-black text-white">Có Tài Xế</h3>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">Đội ngũ tài xế chuyên nghiệp, được đào tạo bài bản, phục vụ tận tâm.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Tài xế riêng
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Kinh nghiệm lâu năm
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Trang phục lịch sự
                        </li>
                    </ul>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-cyan-600 text-white font-bold rounded-xl hover:bg-cyan-700 transition-all w-full justify-center text-sm">
                        Đặt ngay <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                {{-- 3. Sự Kiện VIP - Pink --}}
                <div class="group relative bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-700 hover:border-pink-500/50 transition-all duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-pink-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-gem text-2xl text-white"></i>
                    </div>
                    <div class="mb-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">RED CARPET</p>
                        <h3 class="text-2xl font-black text-white">Sự Kiện VIP</h3>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">Dịch vụ xe hoa, roadshow và đưa đón sự kiện đẳng cấp quốc tế.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Xe hoa sang trọng
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Trang trí theo yêu cầu
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Đội ngũ phục vụ
                        </li>
                    </ul>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-pink-600 text-white font-bold rounded-xl hover:bg-pink-700 transition-all w-full justify-center text-sm">
                        Đặt ngay <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                {{-- 4. Bảo Hiểm - Green --}}
                <div class="group relative bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-700 hover:border-green-500/50 transition-all duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-green-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-shield-halved text-2xl text-white"></i>
                    </div>
                    <div class="mb-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">FULL INSURANCE</p>
                        <h3 class="text-2xl font-black text-white">Bảo Hiểm Toàn Diện</h3>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">Bảo hiểm 100% giá trị xe, yên tâm tuyệt đối trên mọi hành trình.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Bồi thường 100%
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Không cần đặt cọc
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Hỗ trợ sự cố
                        </li>
                    </ul>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all w-full justify-center text-sm">
                        Đặt ngay <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                {{-- 5. Thuê Theo Giờ - Orange --}}
                <div class="group relative bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-700 hover:border-orange-500/50 transition-all duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-orange-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-clock text-2xl text-white"></i>
                    </div>
                    <div class="mb-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">HOURLY RENTAL</p>
                        <h3 class="text-2xl font-black text-white">Thuê Theo Giờ</h3>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">Linh hoạt theo giờ, phù hợp cho những chuyến đi ngắn ngày trong thành phố.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Tối thiểu 4 giờ
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Giá ưu đãi
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Thanh toán linh hoạt
                        </li>
                    </ul>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-orange-600 text-white font-bold rounded-xl hover:bg-orange-700 transition-all w-full justify-center text-sm">
                        Đặt ngay <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                {{-- 6. Doanh Nghiệp - Indigo --}}
                <div class="group relative bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-700 hover:border-indigo-500/50 transition-all duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-building text-2xl text-white"></i>
                    </div>
                    <div class="mb-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">CORPORATE</p>
                        <h3 class="text-2xl font-black text-white">Doanh Nghiệp</h3>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">Giải pháp vận tải toàn diện cho doanh nghiệp, hợp đồng dài hạn ưu đãi.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Hợp đồng linh hoạt
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Giảm giá đặc biệt
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-400">
                            <i class="fa-solid fa-check text-green-500"></i> Quản lý tập trung
                        </li>
                    </ul>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all w-full justify-center text-sm">
                        Đặt ngay <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section class="py-20 bg-gradient-to-br from-gray-900 via-black to-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    {{-- Image Side --}}
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-3xl blur-2xl opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1560179707-f14e90ef3623?q=80&w=2073"
                            alt="Luxury Car"
                            class="relative rounded-3xl shadow-2xl w-full"
                            onerror="this.src='https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=2000'">
                    </div>

                    {{-- Content Side --}}
                    <div>
                        <h2 class="text-4xl md:text-5xl font-black mb-6">
                            <span class="text-white">TẠI SAO CHỌN </span>
                            <span class="bg-gradient-to-r from-blue-500 to-cyan-500 bg-clip-text text-transparent">CHÚNG TÔI?</span>
                        </h2>
                        <p class="text-gray-400 mb-8 leading-relaxed">
                            Chúng tôi tự hào mang đến dịch vụ cho thuê xe cao cấp với cam kết chất lượng hàng đầu.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-blue-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-star text-blue-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white mb-1">Dịch Vụ Chuyên Nghiệp</h4>
                                    <p class="text-sm text-gray-400">Đội ngũ giàu kinh nghiệm, tận tâm phục vụ 24/7</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-cyan-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-shield-halved text-cyan-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white mb-1">An Toàn Tuyệt Đối</h4>
                                    <p class="text-sm text-gray-400">Xe được kiểm định định kỳ, bảo hiểm toàn diện</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-pink-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-tags text-pink-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white mb-1">Giá Cả Cạnh Tranh</h4>
                                    <p class="text-sm text-gray-400">Nhiều ưu đãi hấp dẫn, minh bạch chi phí</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection