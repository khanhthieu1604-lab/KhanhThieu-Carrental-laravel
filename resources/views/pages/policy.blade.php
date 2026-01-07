@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<div class="bg-white dark:bg-[#020202] min-h-screen py-24 transition-colors duration-700 relative overflow-hidden font-sans">
    
    
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none z-0">
        <div class="absolute top-[-5%] right-[-5%] w-[35%] h-[35%] bg-amber-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-5%] left-[-5%] w-[35%] h-[35%] bg-zinc-500/5 rounded-full blur-[120px]"></div>
    </div>

    <div class="container mx-auto px-6 max-w-7xl relative z-10">
        
        
        <div class="text-center mb-24 reveal-header">
            <div class="inline-flex items-center gap-3 py-2 px-6 rounded-full bg-zinc-900 dark:bg-white/5 border border-zinc-100 dark:border-white/10 backdrop-blur-xl mb-10 shadow-2xl">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-[0.5em] text-zinc-900 dark:text-zinc-300">Elite Policy Framework</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-zinc-900 dark:text-white tracking-tighter uppercase mb-6 leading-none">
                Chính sách <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-amber-500 to-amber-700 opacity-80">Minh bạch.</span>
            </h1>
            <p class="text-zinc-500 dark:text-zinc-400 max-w-2xl mx-auto text-sm uppercase tracking-[0.2em] font-medium leading-relaxed">
                Cam kết đảm bảo quyền lợi tuyệt đối cho khách hàng Elite thông qua hệ thống quy chuẩn quốc tế.
            </p>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-stretch">
            
            
            <div class="md:col-span-6 reveal-card group">
                <div class="h-full p-10 rounded-[3rem] bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 backdrop-blur-md hover:border-amber-500/30 transition-all duration-500 shadow-sm hover:shadow-2xl">
                    <div class="flex items-center gap-6 mb-10">
                        <div class="w-16 h-16 rounded-2xl bg-zinc-900 dark:bg-white text-white dark:text-black flex items-center justify-center text-2xl shadow-xl transition-transform group-hover:rotate-[360deg] duration-1000">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <h3 class="text-2xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter">Giao thức <br>Thời gian</h3>
                    </div>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm leading-relaxed font-light mb-8">
                        Thời gian được tính toán chính xác theo chu kỳ 24 giờ kể từ thời điểm bàn giao kiệt tác.
                    </p>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-4 bg-white/50 dark:bg-white/5 rounded-2xl border border-zinc-100 dark:border-white/5">
                            <span class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Phụ thu giờ</span>
                            <span class="text-sm font-black text-amber-500 tracking-widest">100.000đ / h</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-white/50 dark:bg-white/5 rounded-2xl border border-zinc-100 dark:border-white/5">
                            <span class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Ngưỡng quá hạn</span>
                            <span class="text-sm font-black text-amber-500 tracking-widest">> 4 giờ = 1 ngày</span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="md:col-span-6 reveal-card group">
                <div class="h-full p-10 rounded-[3rem] bg-zinc-900 dark:bg-white text-white dark:text-black relative overflow-hidden transition-all duration-500 hover:scale-[1.02]">
                    <div class="absolute top-0 right-0 p-10 opacity-10 rotate-12 pointer-events-none group-hover:rotate-45 transition-transform duration-1000">
                        <i class="fa-solid fa-route text-[180px]"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-6 mb-10">
                            <div class="w-16 h-16 rounded-2xl bg-amber-500 text-black flex items-center justify-center text-2xl shadow-2xl">
                                <i class="fa-solid fa-compass"></i>
                            </div>
                            <h3 class="text-2xl font-black uppercase tracking-tighter">Hành trình <br>Giới hạn</h3>
                        </div>
                        <p class="text-zinc-400 dark:text-zinc-500 text-sm leading-relaxed font-light mb-12 max-w-xs">
                            Mỗi hành trình đều được tối ưu hóa để bảo trì tình trạng hoàn hảo nhất cho xe.
                        </p>
                        <div class="flex items-end gap-2">
                            <span class="text-6xl font-black tracking-tighter uppercase">300</span>
                            <span class="text-sm font-black uppercase tracking-widest mb-2 opacity-50 text-amber-500">Km / Ngày</span>
                        </div>
                        <p class="mt-4 text-[10px] font-black uppercase tracking-[0.2em] opacity-40">Phụ trội hỏa tốc: 5.000đ/km</p>
                    </div>
                </div>
            </div>

            
            <div class="md:col-span-7 reveal-card group">
                <div class="h-full p-10 rounded-[3rem] bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 backdrop-blur-md shadow-sm hover:border-red-500/30 transition-all duration-500">
                    <div class="flex items-center gap-6 mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-red-500/10 text-red-500 flex items-center justify-center text-2xl">
                            <i class="fa-solid fa-shield-virus"></i>
                        </div>
                        <h3 class="text-2xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter">Bảo hộ & <br>Trách nhiệm</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <h4 class="text-xs font-black uppercase tracking-widest text-zinc-900 dark:text-white">Bảo hiểm Elite</h4>
                            <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed font-light italic text-justify">Hệ thống bảo hiểm 2 chiều cao cấp được kích hoạt mặc định cho mọi giao dịch thuê xe.</p>
                        </div>
                        <div class="space-y-4">
                            <h4 class="text-xs font-black uppercase tracking-widest text-zinc-900 dark:text-white">Giới hạn rủi ro</h4>
                            <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed font-light italic text-justify">Khách hàng chỉ chịu trách nhiệm trong mức miễn thường theo quy định của hãng bảo hiểm.</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="md:col-span-5 reveal-card group">
                <div class="h-full p-10 rounded-[3rem] bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 backdrop-blur-md shadow-sm hover:border-emerald-500/30 transition-all duration-500">
                    <div class="flex items-center gap-6 mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-2xl">
                            <i class="fa-solid fa-gas-pump"></i>
                        </div>
                        <h3 class="text-2xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter">Năng lượng <br>Bàn giao</h3>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-4 text-xs font-medium text-zinc-500 dark:text-zinc-400 leading-relaxed">
                            <i class="fa-solid fa-circle-check text-emerald-500 mt-1"></i>
                            Bình nhiên liệu được nạp đầy tiêu chuẩn trước khi bàn giao.
                        </li>
                        <li class="flex items-start gap-4 text-xs font-medium text-zinc-500 dark:text-zinc-400 leading-relaxed">
                            <i class="fa-solid fa-circle-check text-emerald-500 mt-1"></i>
                            Hoàn trả xe với mức năng lượng tương đương để tối ưu quy trình.
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        
        <div class="mt-40 text-center reveal-footer opacity-0">
            <p class="text-zinc-400 text-[10px] uppercase tracking-[0.4em] font-black mb-8">Cần giải đáp chi tiết hơn?</p>
            <a href="{{ route('pages.faq') }}" class="inline-flex items-center gap-6 px-12 py-5 bg-zinc-900 dark:bg-white text-white dark:text-black rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-amber-500 dark:hover:bg-amber-500 dark:hover:text-black transition-all duration-500 group shadow-2xl">
                Truy cập Trung tâm hỗ trợ
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
        targets: '.reveal-card',
        opacity: [0, 1],
        translateY: [30, 0],
        delay: anime.stagger(150),
        duration: 1200,
        offset: '-=1000'
    })
    .add({
        targets: '.reveal-footer',
        opacity: [0, 1],
        scale: [0.95, 1],
        duration: 1500,
        offset: '-=800'
    });
});
</script>

<style>
    
    ::-webkit-scrollbar { width: 0px; }
    
    
    .reveal-card {
        will-change: transform, opacity;
    }
</style>
@endsection