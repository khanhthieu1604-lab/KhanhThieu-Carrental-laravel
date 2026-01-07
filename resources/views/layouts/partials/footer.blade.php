<footer class="relative bg-[#050505] text-gray-400 font-sans text-sm border-t border-white/10 overflow-hidden">
    
    
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" 
         style="background-image: radial-gradient(#eab308 1px, transparent 1px); background-size: 32px 32px;">
    </div>

    
    <div class="border-b border-white/10 bg-white/5 backdrop-blur-sm relative z-10">
        <div class="container mx-auto px-4 py-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-black text-white uppercase tracking-wide mb-1">Bạn đã sẵn sàng?</h3>
                <p class="text-gray-500 text-xs">Đặt xe ngay hôm nay để nhận ưu đãi lên đến 20%.</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('vehicles.index') }}" class="px-8 py-3 bg-yellow-500 hover:bg-yellow-400 text-black font-black uppercase text-xs tracking-widest rounded-full transition-transform hover:scale-105 shadow-[0_0_20px_rgba(234,179,8,0.3)]">
                    Đặt Xe Ngay
                </a>
                <a href="tel:0909123456" class="px-8 py-3 border border-white/20 text-white font-bold uppercase text-xs tracking-widest rounded-full hover:bg-white/10 transition-colors">
                    Gọi 0909.123.456
                </a>
            </div>
        </div>
    </div>

    
    <div class="container mx-auto px-4 py-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            
            
            <div class="space-y-6">
                <a href="{{ route('home') }}" class="inline-block group">
                    <span class="text-3xl font-black text-white tracking-tighter group-hover:text-yellow-500 transition-colors duration-500">
                        THIUU<span class="text-yellow-500 group-hover:text-white transition-colors duration-500">RENTAL</span>
                    </span>
                </a>
                <p class="text-gray-500 text-xs leading-relaxed text-justify">
                    Đơn vị tiên phong trong lĩnh vực cho thuê xe hạng sang tại Việt Nam. Trải nghiệm thượng lưu và phong cách sống đẳng cấp.
                </p>
                <div class="flex gap-4 pt-2">
                    @foreach(['facebook-f', 'instagram', 'tiktok', 'youtube'] as $icon)
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/5 flex items-center justify-center text-gray-400 hover:text-black hover:bg-yellow-500 hover:border-yellow-500 hover:shadow-[0_0_15px_rgba(234,179,8,0.6)] transition-all duration-300">
                        <i class="fa-brands fa-{{ $icon }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            
            <div>
                <h4 class="text-white font-bold uppercase text-xs tracking-[0.2em] mb-6 border-l-2 border-yellow-500 pl-3">Khám Phá</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}" class="hover:text-yellow-500 hover:pl-2 transition-all duration-300 block">Trang chủ</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-yellow-500 hover:pl-2 transition-all duration-300 block">Về chúng tôi</a></li>
                    <li><a href="{{ route('vehicles.index') }}" class="hover:text-yellow-500 hover:pl-2 transition-all duration-300 block">Bộ sưu tập xe</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-yellow-500 hover:pl-2 transition-all duration-300 block">Dịch vụ tài xế VIP</a></li>
                    <li><a href="{{ route('pages.blog') }}" class="hover:text-yellow-500 hover:pl-2 transition-all duration-300 block">Blog xe sang</a></li>
                </ul>
            </div>

            
            <div>
                <h4 class="text-white font-bold uppercase text-xs tracking-[0.2em] mb-6 border-l-2 border-yellow-500 pl-3">Hỗ Trợ Khách Hàng</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('pages.policy') }}" class="hover:text-yellow-500 hover:pl-2 transition-all duration-300 block">Chính sách thuê xe</a></li>
                    <li><a href="{{ route('pages.procedures') }}" class="hover:text-yellow-500 hover:pl-2 transition-all duration-300 block">Thủ tục & Giấy tờ</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="hover:text-yellow-500 hover:pl-2 transition-all duration-300 block">Câu hỏi thường gặp</a></li>
                    <li><a href="{{ route('pages.payment') }}" class="hover:text-yellow-500 hover:pl-2 transition-all duration-300 block">Phương thức thanh toán</a></li>
                    <li><a href="{{ route('pages.partnership') }}" class="hover:text-yellow-500 hover:pl-2 transition-all duration-300 block">Liên hệ hợp tác</a></li>
                </ul>
            </div>

            
            <div>
                <h4 class="text-white font-bold uppercase text-xs tracking-[0.2em] mb-6 border-l-2 border-yellow-500 pl-3">Showroom</h4>
                <ul class="space-y-5">
                    <li class="flex items-start gap-4 group">
                        <div class="mt-1 w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center flex-shrink-0 text-yellow-500 group-hover:bg-yellow-500 group-hover:text-black transition-all">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <span class="block text-white font-bold text-xs uppercase mb-1">Địa chỉ chính</span>
                            <span class="text-xs leading-relaxed hover:text-yellow-500 transition cursor-pointer">123 Đại Lộ Nguyễn Huệ,<br>Quận 1, TP. Hồ Chí Minh</span>
                        </div>
                    </li>
                    <li class="flex items-center gap-4 group">
                        <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center flex-shrink-0 text-yellow-500 group-hover:bg-yellow-500 group-hover:text-black transition-all">
                            <i class="fa-solid fa-phone-volume"></i>
                        </div>
                        <div>
                            <span class="block text-white font-bold text-xs uppercase mb-1">Hotline 24/7</span>
                            <a href="tel:0909123456" class="text-lg font-black text-white hover:text-yellow-500 transition">0909.123.456</a>
                        </div>
                    </li>
                    <li class="flex items-center gap-4 group">
                        <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center flex-shrink-0 text-yellow-500 group-hover:bg-yellow-500 group-hover:text-black transition-all">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <span class="block text-white font-bold text-xs uppercase mb-1">Email hỗ trợ</span>
                            <a href="mailto:vip@thiuurental.com" class="text-xs hover:text-yellow-500 transition">vip@thiuurental.com</a>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    
    <div class="border-t border-white/10 bg-[#020202] relative z-10">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-[10px] text-gray-600 text-center md:text-left">
                    <p>&copy; {{ date('Y') }} <strong class="text-gray-400">Thiuu Rental Group</strong>. All rights reserved.</p>
                    <p class="mt-1">Designed with <i class="fa-solid fa-heart text-red-900 mx-1"></i> by <span class="text-yellow-900">Thieu</span>.</p>
                </div>
                <div class="flex items-center gap-6 opacity-50 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                    <i class="fa-brands fa-cc-visa text-2xl text-white"></i>
                    <i class="fa-brands fa-cc-mastercard text-2xl text-white"></i>
                    <i class="fa-brands fa-cc-paypal text-2xl text-white"></i>
                    <i class="fa-brands fa-cc-apple-pay text-2xl text-white"></i>
                </div>
            </div>
        </div>
    </div>
</footer>