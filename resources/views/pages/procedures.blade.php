@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<div class="bg-white dark:bg-[#020202] min-h-screen py-24 transition-colors duration-700 relative overflow-hidden font-sans">
    
    
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none z-0">
        <div class="absolute top-[10%] left-[5%] w-[40%] h-[40%] bg-blue-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[10%] right-[5%] w-[40%] h-[40%] bg-zinc-500/5 rounded-full blur-[120px]"></div>
        
        <div class="absolute inset-0 opacity-[0.02] dark:opacity-[0.05]" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 40px 40px;"></div>
    </div>

    <div class="container mx-auto px-6 max-w-6xl relative z-10">
        
        
        <div class="text-center mb-24 reveal-header">
            <div class="inline-flex items-center gap-3 py-2 px-6 rounded-full bg-zinc-900 dark:bg-white/5 border border-zinc-100 dark:border-white/10 backdrop-blur-xl mb-10 shadow-2xl">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-[0.5em] text-zinc-900 dark:text-zinc-300">Elite Onboarding Protocol</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-zinc-900 dark:text-white tracking-tighter uppercase mb-6 leading-none">
                Quy trình <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-400 to-blue-600 opacity-90">Bàn giao.</span>
            </h1>
            <p class="text-zinc-500 dark:text-zinc-400 max-w-2xl mx-auto text-sm uppercase tracking-[0.2em] font-medium leading-relaxed">
                Tối giản hóa mọi thủ tục phức tạp thành trải nghiệm kỹ thuật số trong 300 giây.
            </p>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch mb-20">
            
            
            <div class="md:col-span-7 reveal-step">
                <div class="group h-full p-10 rounded-[3rem] bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 backdrop-blur-md hover:border-blue-500/30 transition-all duration-500 shadow-sm hover:shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-[0.03] group-hover:opacity-10 transition-opacity">
                        <i class="fa-solid fa-address-card text-[150px]"></i>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-6 mb-12">
                            <div class="w-16 h-16 rounded-2xl bg-zinc-900 dark:bg-white text-white dark:text-black flex items-center justify-center text-2xl font-black shadow-2xl">01</div>
                            <h3 class="text-2xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter">Xác thực <br>Định danh</h3>
                        </div>

                        <p class="text-zinc-500 dark:text-zinc-400 text-sm leading-relaxed font-light mb-10 max-w-md">
                            Chúng tôi sử dụng công nghệ đối chiếu sinh trắc học để đảm bảo tính chính xác và bảo mật thông tin tuyệt đối.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex items-center gap-4 p-5 bg-white/50 dark:bg-white/5 rounded-2xl border border-zinc-100 dark:border-white/5 group/item hover:bg-blue-500/10 transition-colors">
                                <i class="fa-solid fa-id-card text-blue-500 text-xl"></i>
                                <span class="text-[10px] font-black uppercase tracking-widest text-zinc-700 dark:text-zinc-300">CCCD Gắn Chip</span>
                            </div>
                            <div class="flex items-center gap-4 p-5 bg-white/50 dark:bg-white/5 rounded-2xl border border-zinc-100 dark:border-white/5 group/item hover:bg-blue-500/10 transition-colors">
                                <i class="fa-solid fa-id-badge text-blue-500 text-xl"></i>
                                <span class="text-[10px] font-black uppercase tracking-widest text-zinc-700 dark:text-zinc-300">GPLX Hạng B1+</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="md:col-span-5 reveal-step">
                <div class="h-full p-10 rounded-[3rem] bg-zinc-900 dark:bg-white text-white dark:text-black relative overflow-hidden transition-all duration-500 hover:scale-[1.02]">
                    <div class="absolute -bottom-10 -left-10 p-10 opacity-10 rotate-12">
                        <i class="fa-solid fa-vault text-[150px]"></i>
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-6 mb-12">
                            <div class="w-16 h-16 rounded-2xl bg-amber-500 text-black flex items-center justify-center text-2xl font-black shadow-2xl">02</div>
                            <h3 class="text-2xl font-black uppercase tracking-tighter">Ký quỹ <br>Tín nhiệm</h3>
                        </div>

                        <div class="space-y-6">
                            <div class="p-6 rounded-2xl bg-white/10 dark:bg-black/5 border border-white/10 dark:border-black/10 backdrop-blur-md">
                                <p class="text-[9px] font-black uppercase tracking-[0.2em] mb-3 opacity-60 text-amber-500">Lựa chọn 01</p>
                                <p class="text-xs font-bold uppercase tracking-widest flex items-center gap-3">
                                    <i class="fa-solid fa-motorcycle"></i> Xe máy & Cà vẹt gốc
                                </p>
                            </div>
                            <div class="p-6 rounded-2xl bg-white/10 dark:bg-black/5 border border-white/10 dark:border-black/10 backdrop-blur-md">
                                <p class="text-[9px] font-black uppercase tracking-[0.2em] mb-3 opacity-60 text-amber-500">Lựa chọn 02</p>
                                <p class="text-xs font-bold uppercase tracking-widest flex items-center gap-3">
                                    <i class="fa-solid fa-money-bill-transfer"></i> 15,000,000đ Tiền mặt
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="md:col-span-12 reveal-step">
                <div class="p-10 rounded-[3rem] bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 backdrop-blur-md shadow-sm hover:border-emerald-500/30 transition-all duration-500">
                    <div class="flex flex-col md:flex-row justify-between gap-12">
                        <div class="md:w-1/2">
                            <div class="flex items-center gap-6 mb-8">
                                <div class="w-16 h-16 rounded-2xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-2xl font-black">03</div>
                                <h3 class="text-2xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter">Kiểm định <br>& Bàn giao</h3>
                            </div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm font-light leading-relaxed mb-8 italic">
                                "Mọi chi tiết ngoại thất, nội thất và hệ thống vận hành được ghi nhận bằng hình ảnh 4K trước khi khách hàng ký nhận bàn giao."
                            </p>
                        </div>
                        <div class="md:w-1/2 grid grid-cols-2 gap-4">
                            @foreach(['Video Checkout', 'Digital Signature', 'Real-time GPS', 'Full Fuel Tank'] as $item)
                            <div class="flex items-center gap-3 text-[9px] font-black uppercase tracking-widest text-zinc-400">
                                <i class="fa-solid fa-circle-check text-emerald-500"></i> {{ $item }}
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="max-w-3xl mx-auto bg-blue-500/5 dark:bg-blue-500/10 p-8 rounded-[2.5rem] border border-blue-500/20 text-center reveal-footer opacity-0">
            <p class="text-blue-600 dark:text-blue-400 text-xs font-black uppercase tracking-[0.3em] flex items-center justify-center gap-3">
                <i class="fa-solid fa-shield-halved text-lg"></i>
                Cam kết hoàn trả tài sản ký quỹ ngay lập tức sau khi kết thúc lộ trình.
            </p>
        </div>

        
        <div class="mt-20 text-center reveal-footer opacity-0">
            <a href="{{ route('vehicles.index') }}" class="inline-flex items-center gap-6 px-12 py-5 bg-zinc-900 dark:bg-white text-white dark:text-black rounded-full text-[10px] font-black uppercase tracking-widest hover:scale-105 transition-all duration-500 group shadow-2xl">
                Bắt đầu hành trình của bạn
                <i class="fa-solid fa-arrow-right-long group-hover:translate-x-3 transition-transform"></i>
            </a>
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
        targets: '.reveal-step',
        opacity: [0, 1],
        translateY: [30, 0],
        delay: anime.stagger(200),
        duration: 1200,
        offset: '-=1000'
    })
    .add({
        targets: '.reveal-footer',
        opacity: [0, 1],
        scale: [0.9, 1],
        duration: 1500,
        offset: '-=800'
    });
});
</script>

<style>
    
    ::-webkit-scrollbar { width: 0px; }
    
    
    .reveal-step {
        will-change: transform, opacity;
    }
</style>
@endsection