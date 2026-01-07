@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<div class="bg-white dark:bg-[#020202] min-h-screen py-24 transition-colors duration-700 relative overflow-hidden font-sans">
    
    
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none z-0">
        <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-amber-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-500/5 rounded-full blur-[120px]"></div>
    </div>

    <div class="container mx-auto px-6 max-w-7xl relative z-10">
        
        
        <div class="text-center mb-24 reveal-header">
            <div class="inline-flex items-center gap-3 py-2 px-6 rounded-full bg-zinc-900 dark:bg-white/5 border border-zinc-100 dark:border-white/10 backdrop-blur-xl mb-10 shadow-2xl">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-[0.5em] text-zinc-900 dark:text-zinc-300">Elite Partnership Program</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-zinc-900 dark:text-white tracking-tighter uppercase mb-6 leading-none">
                Hợp tác <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-amber-500 to-amber-700 opacity-80">Thịnh Vượng.</span>
            </h1>
            <p class="text-zinc-500 dark:text-zinc-400 max-w-2xl mx-auto text-sm uppercase tracking-[0.2em] font-medium leading-relaxed">
                Kết nối tài sản của bạn vào hệ thống vận hành siêu xe chuyên nghiệp nhất Việt Nam. Minh bạch – An toàn – Đẳng cấp.
            </p>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            
            <div class="lg:col-span-8 space-y-8">
                
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 reveal-card">
                    @php
                        $stats = [
                            ['val' => '500+', 'label' => 'Chủ xe tin dùng', 'icon' => 'fa-crown'],
                            ['val' => '85%', 'label' => 'Chia sẻ lợi nhuận', 'icon' => 'fa-chart-pie'],
                            ['val' => '24/7', 'label' => 'Hệ thống giám sát', 'icon' => 'fa-satellite'],
                        ];
                    @endphp
                    @foreach($stats as $s)
                    <div class="p-8 rounded-[2.5rem] bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 backdrop-blur-md hover:border-amber-500/30 transition-all group">
                        <i class="fa-solid {{ $s['icon'] }} text-amber-500 text-xl mb-6 group-hover:scale-110 transition-transform"></i>
                        <h4 class="text-4xl font-black text-zinc-900 dark:text-white mb-2 tracking-tighter">{{ $s['val'] }}</h4>
                        <p class="text-[10px] font-black uppercase tracking-widest text-zinc-400">{{ $s['label'] }}</p>
                    </div>
                    @endforeach
                </div>

                
                <div class="bg-zinc-900 dark:bg-white p-12 rounded-[3rem] text-white dark:text-black relative overflow-hidden reveal-card">
                    <div class="absolute top-0 right-0 p-10 opacity-10 rotate-12 pointer-events-none">
                        <i class="fa-solid fa-mobile-screen text-[200px]"></i>
                    </div>
                    <div class="relative z-10 max-w-lg">
                        <h3 class="text-3xl font-black uppercase tracking-tighter mb-6 italic">Quản trị số tuyệt đối</h3>
                        <p class="text-zinc-400 dark:text-zinc-500 text-sm leading-relaxed mb-10 font-light">
                            Theo dõi lịch trình, trạng thái kỹ thuật và báo cáo doanh thu thực tế của xe bạn ngay trên Dashboard cá nhân. Minh bạch đến từng km.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <span class="px-4 py-2 rounded-full border border-white/20 dark:border-black/10 text-[9px] font-black uppercase tracking-widest">GPS Real-time</span>
                            <span class="px-4 py-2 rounded-full border border-white/20 dark:border-black/10 text-[9px] font-black uppercase tracking-widest">Auto Insurance 2-way</span>
                            <span class="px-4 py-2 rounded-full border border-white/20 dark:border-black/10 text-[9px] font-black uppercase tracking-widest">KYC 3-Layer</span>
                        </div>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 reveal-card">
                    <div class="p-10 rounded-[3rem] bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5">
                        <div class="w-12 h-12 rounded-2xl bg-blue-500 text-white flex items-center justify-center mb-8 shadow-xl shadow-blue-500/20">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h4 class="text-xl font-black text-zinc-900 dark:text-white uppercase mb-4 tracking-tight">Thẩm định khách thuê</h4>
                        <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed font-light">Quy trình thẩm định khách hàng (KYC) bằng công nghệ sinh trắc học và lịch sử tín dụng, loại bỏ 99% rủi ro tài sản.</p>
                    </div>
                    <div class="p-10 rounded-[3rem] bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center mb-8 shadow-xl shadow-emerald-500/20">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </div>
                        <h4 class="text-xl font-black text-zinc-900 dark:text-white uppercase mb-4 tracking-tight">Bảo dưỡng tiêu chuẩn</h4>
                        <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed font-light">Xe của bạn được chăm sóc bởi đội ngũ kỹ thuật hãng theo lịch trình nghiêm ngặt, duy trì giá trị tài sản ở mức cao nhất.</p>
                    </div>
                </div>
            </div>

            
            <div class="lg:col-span-4 sticky top-32 reveal-form">
                <div class="p-10 rounded-[3rem] bg-white dark:bg-[#0a0a0a] border border-zinc-100 dark:border-white/5 shadow-2xl relative">
                    <div class="mb-10">
                        <h3 class="text-2xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter mb-2">Đăng ký Tư vấn</h3>
                        <p class="text-[10px] text-zinc-400 uppercase tracking-widest">Hồi đáp trong 05 phút làm việc</p>
                    </div>

                    <form action="#" class="space-y-4">
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase text-zinc-400 ml-4 tracking-widest">Chủ sở hữu</label>
                            <input type="text" placeholder="Họ và tên" class="w-full bg-zinc-50 dark:bg-white/5 border-none rounded-2xl p-5 text-sm text-zinc-900 dark:text-white focus:ring-1 focus:ring-amber-500/50 transition-all">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase text-zinc-400 ml-4 tracking-widest">Liên hệ</label>
                            <input type="tel" placeholder="Số điện thoại" class="w-full bg-zinc-50 dark:bg-white/5 border-none rounded-2xl p-5 text-sm text-zinc-900 dark:text-white focus:ring-1 focus:ring-amber-500/50 transition-all">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase text-zinc-400 ml-4 tracking-widest">Mẫu xe</label>
                            <input type="text" placeholder="Dòng xe (VD: Porsche 911)" class="w-full bg-zinc-50 dark:bg-white/5 border-none rounded-2xl p-5 text-sm text-zinc-900 dark:text-white focus:ring-1 focus:ring-amber-500/50 transition-all">
                        </div>
                        
                        <button type="button" class="w-full py-5 mt-6 bg-amber-500 text-black rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all">
                            Gửi yêu cầu Hợp tác
                        </button>
                    </form>

                    <div class="mt-10 pt-8 border-t border-zinc-100 dark:border-white/5 text-center">
                        <p class="text-[9px] text-zinc-400 uppercase tracking-widest mb-4">Hoặc kết nối trực tiếp quản lý VIP</p>
                        <a href="tel:0909123456" class="text-xl font-black text-zinc-900 dark:text-white hover:text-amber-500 transition-colors animate-pulse">
                            <i class="fa-solid fa-phone-volume mr-2 text-amber-500"></i> 0909.123.456
                        </a>
                    </div>
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
        targets: '.reveal-card',
        opacity: [0, 1],
        translateY: [30, 0],
        delay: anime.stagger(150),
        duration: 1200,
        offset: '-=1000'
    })
    .add({
        targets: '.reveal-form',
        opacity: [0, 1],
        scale: [0.95, 1],
        duration: 1500,
        offset: '-=800'
    });
});
</script>

<style>
    
    input::placeholder { font-weight: 700; text-transform: uppercase; font-size: 10px; letter-spacing: 0.1em; opacity: 0.4; }
    
    
    input:focus { transform: translateY(-2px); box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1); }
</style>
@endsection