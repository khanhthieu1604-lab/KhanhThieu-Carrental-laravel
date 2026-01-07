@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<div class="bg-white dark:bg-[#020202] min-h-screen py-24 transition-colors duration-700 font-sans relative overflow-hidden">
    
    
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-amber-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-500/5 rounded-full blur-[120px]"></div>
    </div>

    <div class="container mx-auto px-6 max-w-5xl relative z-10">
        
        
        <div class="text-center mb-24 reveal-header">
            <div class="inline-flex items-center gap-3 py-2 px-6 rounded-full bg-zinc-900 dark:bg-white/5 border border-zinc-100 dark:border-white/10 backdrop-blur-xl mb-10 shadow-2xl">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-[0.5em] text-zinc-900 dark:text-zinc-300">Elite Support System</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-zinc-900 dark:text-white tracking-tighter uppercase mb-6 leading-none">
                Trung tâm <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-amber-500 to-amber-700 opacity-80">Giải đáp.</span>
            </h1>
            <p class="text-zinc-500 dark:text-zinc-400 max-w-xl mx-auto text-sm uppercase tracking-[0.2em] font-medium leading-relaxed">
                Hệ thống truy xuất thông tin tự động dành riêng cho khách hàng Elite của Thiuu Rental.
            </p>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            
            
            <div class="md:col-span-4 sticky top-32 hidden md:block side-nav opacity-0">
                <div class="p-8 rounded-[2.5rem] bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 backdrop-blur-md">
                    <h4 class="text-[10px] font-black text-amber-600 dark:text-amber-500 uppercase tracking-[0.4em] mb-8">Danh mục nội dung</h4>
                    <nav class="space-y-6">
                        @foreach(['Thủ tục', 'Thanh toán', 'Vận hành'] as $cat)
                        <a href="#" class="flex items-center gap-4 text-xs font-black uppercase tracking-widest text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-all group">
                            <span class="w-2 h-2 rounded-full border border-zinc-300 dark:border-zinc-700 group-hover:bg-amber-500 group-hover:border-amber-500 transition-all"></span>
                            {{ $cat }}
                        </a>
                        @endforeach
                    </nav>
                </div>
            </div>

            
            <div class="md:col-span-8 space-y-12">
                
                
                <div class="faq-group opacity-0">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-900 dark:bg-white text-white dark:text-black flex items-center justify-center text-xl shadow-xl">
                            <i class="fa-solid fa- fingerprints"></i>
                        </div>
                        <h3 class="text-2xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter">Định danh khách hàng</h3>
                    </div>

                    <div class="space-y-4" x-data="{ selected: null }">
                        @php
                            $docs = [
                                1 => ['q' => 'Tôi cần những giấy tờ gì để thuê xe?', 'a' => 'Quy trình định danh Elite bao gồm: <br><br> • CCCD gắn chip bản gốc. <br> • Giấy phép lái xe hạng B1+ (VNeID mức 2). <br> • Ký quỹ an toàn (Xe máy chính chủ hoặc 15,000,000đ).'],
                                2 => ['q' => 'Hỗ trợ khách hàng không có hộ khẩu?', 'a' => 'Chúng tôi áp dụng quy trình ưu tiên cho khách du lịch. Quý khách chỉ cần cung cấp Passport còn hạn và vé máy bay khứ hồi để được xác thực ngay lập tức.'],
                            ];
                        @endphp
                        @foreach($docs as $id => $item)
                        <div class="group relative bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 rounded-[2rem] overflow-hidden transition-all duration-500 hover:shadow-2xl" :class="selected === {{ $id }} ? 'ring-1 ring-amber-500/50' : ''">
                            <button @click="selected !== {{ $id }} ? selected = {{ $id }} : selected = null" class="w-full flex justify-between items-center p-8 text-left focus:outline-none">
                                <span class="font-bold text-zinc-800 dark:text-zinc-200 text-base tracking-tight uppercase group-hover:text-amber-500 transition-colors">{{ $item['q'] }}</span>
                                <div class="w-8 h-8 rounded-full border border-zinc-200 dark:border-white/10 flex items-center justify-center text-xs transition-all" :class="selected === {{ $id }} ? 'bg-amber-500 border-amber-500 text-black rotate-180' : 'text-zinc-400'">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </button>
                            <div x-show="selected === {{ $id }}" x-collapse class="px-8 pb-8 text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed font-light border-t border-zinc-100 dark:border-white/5 pt-6 italic">
                                {!! $item['a'] !!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                
                <div class="faq-group opacity-0">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500 text-black flex items-center justify-center text-xl shadow-2xl shadow-amber-500/20">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h3 class="text-2xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter">Bảo mật giao dịch</h3>
                    </div>

                    <div class="space-y-4" x-data="{ selected: null }">
                        @php
                            $payments = [
                                3 => ['q' => 'Chính sách đặt cọc và giữ xe?', 'a' => 'Để đảm bảo tính độc quyền của dòng xe đã chọn, quý khách vui lòng thanh toán trước <strong>50% giá trị hợp đồng</strong>. Hệ thống sẽ khóa lịch xe ngay lập tức cho quý khách.'],
                                4 => ['q' => 'Quy định hủy lịch đặc quyền?', 'a' => 'Hủy trước 24h: Hoàn trả 100% qua hệ thống ngân hàng. <br> Hủy trong vòng 24h: Phí giữ xe tương đương 50% tiền cọc.'],
                            ];
                        @endphp
                        @foreach($payments as $id => $item)
                        <div class="bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 rounded-[2rem] overflow-hidden transition-all duration-500 hover:border-amber-500/30" :class="selected === {{ $id }} ? 'bg-zinc-100 dark:bg-white/[0.05]' : ''">
                            <button @click="selected !== {{ $id }} ? selected = {{ $id }} : selected = null" class="w-full flex justify-between items-center p-8 text-left focus:outline-none">
                                <span class="font-bold text-zinc-800 dark:text-zinc-200 text-base tracking-tight uppercase">{{ $item['q'] }}</span>
                                <i class="fa-solid fa-circle-plus text-amber-500 transition-all duration-500" :class="selected === {{ $id }} ? 'rotate-45 opacity-20' : ''"></i>
                            </button>
                            <div x-show="selected === {{ $id }}" x-collapse class="px-8 pb-8 text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed font-light pt-4 border-t border-dashed border-zinc-200 dark:border-white/10">
                                {!! $item['a'] !!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        
        <div class="mt-40 text-center reveal-footer opacity-0">
            <div class="bg-zinc-900 dark:bg-white p-12 md:p-20 rounded-[4rem] text-white dark:text-black relative overflow-hidden">
                <div class="absolute top-0 right-0 p-10 opacity-10 rotate-12">
                    <i class="fa-solid fa-headset text-[200px]"></i>
                </div>
                
                <h3 class="text-3xl md:text-5xl font-black uppercase tracking-tighter mb-6 relative z-10">Bạn cần hỗ trợ <br> cá nhân hóa?</h3>
                <p class="text-zinc-400 dark:text-zinc-500 text-xs md:text-sm uppercase tracking-[0.4em] font-bold mb-12 relative z-10">Hotline Concierge phục vụ 24/7</p>
                
                <div class="flex flex-col md:flex-row justify-center gap-6 relative z-10">
                    <a href="tel:0909123456" class="px-10 py-5 bg-white/10 dark:bg-black/5 backdrop-blur-xl border border-white/20 dark:border-black/10 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-amber-500 hover:text-black transition-all duration-500">
                        Voice Call: 0909.123.456
                    </a>
                    <a href="https://zalo.me/0909123456" class="px-12 py-5 bg-amber-500 text-black rounded-full text-[10px] font-black uppercase tracking-widest hover:scale-105 transition-all shadow-xl shadow-amber-500/20">
                        Secure Chat Zalo
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const tl = anime.timeline({ easing: 'easeOutExpo' });

    tl.add({
        targets: '.reveal-header',
        opacity: [0, 1],
        translateY: [50, 0],
        duration: 1500,
        delay: 200
    })
    .add({
        targets: '.side-nav',
        opacity: [0, 1],
        translateX: [-30, 0],
        duration: 1000,
        offset: '-=1000'
    })
    .add({
        targets: '.faq-group',
        opacity: [0, 1],
        translateY: [30, 0],
        delay: anime.stagger(200),
        duration: 1200,
        offset: '-=800'
    })
    .add({
        targets: '.reveal-footer',
        opacity: [0, 1],
        scale: [0.95, 1],
        duration: 1500,
        offset: '-=500'
    });

    
    const cards = document.querySelectorAll('.faq-group > div > div');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            anime({
                targets: card,
                scale: 1.01,
                duration: 400,
                easing: 'easeOutCubic'
            });
        });
        card.addEventListener('mouseleave', () => {
            anime({
                targets: card,
                scale: 1,
                duration: 400,
                easing: 'easeOutCubic'
            });
        });
    });
});
</script>

<style>
    
    [x-cloak] { display: none !important; }
    
    
    .faq-group div {
        will-change: transform, opacity;
    }
</style>
@endsection