@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<div class="bg-white dark:bg-[#020202] min-h-screen py-24 transition-colors duration-700 relative overflow-hidden font-sans">
    
    
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none z-0">
        <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] bg-amber-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[50%] h-[50%] bg-zinc-500/5 rounded-full blur-[120px]"></div>
    </div>

    
    <div id="scroll-progress" class="fixed top-0 left-0 h-[2px] bg-amber-500 z-[100] transition-all duration-100 ease-out" style="width: 0%"></div>

    <div class="max-w-4xl mx-auto px-8 relative z-10">
        
        
        <div class="mb-32 reveal-header">
            <div class="inline-flex items-center gap-3 py-2 px-6 rounded-full bg-zinc-900 dark:bg-white/5 border border-zinc-100 dark:border-white/10 backdrop-blur-xl mb-10 shadow-2xl">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-[0.5em] text-zinc-900 dark:text-zinc-300">Elite Legal Framework</span>
            </div>

            <h1 class="text-7xl md:text-9xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter mb-12 leading-[0.85]">
                Điều khoản <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-amber-500 to-amber-700 opacity-80 italic">Elite Access</span>
            </h1>

            <div class="flex flex-col md:flex-row md:items-center gap-8 border-l-2 border-amber-500 pl-8">
                <p class="text-zinc-500 dark:text-zinc-400 text-[10px] font-black uppercase tracking-[0.3em] leading-loose">
                    Phiên bản 2.0.1 <br> Hiệu lực từ: {{ date('M Y') }}
                </p>
                <div class="hidden md:block w-12 h-px bg-zinc-200 dark:bg-zinc-800"></div>
                <p class="text-zinc-400 text-xs font-light italic">
                    Vui lòng đọc kỹ các giao thức này để hiểu rõ quyền lợi và trách nhiệm của thành viên Elite.
                </p>
            </div>
        </div>

        
        <div class="space-y-32">
            
            @php
                $terms = [
                    [
                        'id' => '01',
                        'title' => 'Điều kiện thành viên',
                        'content' => 'Người thuê xe phải từ 21 tuổi trở lên và sở hữu bằng lái xe hợp lệ. Đối với các dòng xe Hypercar, chúng tôi yêu cầu xác minh hồ sơ năng lực lái xe hoặc chứng chỉ Elite Driver của Thiuu Rental.',
                        'tags' => ['Age 21+', 'Valid License', 'Elite Driver Cert']
                    ],
                    [
                        'id' => '02',
                        'title' => 'Bảo mật & Định danh',
                        'content' => 'Mọi thông tin khách hàng được mã hóa chuẩn Thụy Sĩ. Chúng tôi cam kết không tiết lộ lộ trình di chuyển của quý khách cho bên thứ ba, trừ trường hợp có yêu cầu từ cơ quan chức năng có thẩm quyền.',
                        'tags' => ['Swiss Encryption', 'Privacy First', 'Non-disclosure']
                    ],
                    [
                        'id' => '03',
                        'title' => 'Trách nhiệm tài sản',
                        'content' => 'Xe được bàn giao trong tình trạng hoàn hảo. Quý khách có trách nhiệm bảo quản tài sản. Mọi hư hỏng do vận hành sai quy cách sẽ được đánh giá bởi đội ngũ kỹ thuật chuyên nghiệp của hãng.',
                        'tags' => ['Asset Protection', 'Professional Audit', 'Zero Compromise']
                    ]
                ];
            @endphp

            @foreach($terms as $term)
            <section class="reveal-content group">
                <div class="flex flex-col md:flex-row items-start gap-12">
                    <div class="flex-shrink-0">
                        <span class="text-7xl font-black text-transparent bg-clip-text bg-gradient-to-b from-amber-500/40 to-transparent opacity-50 group-hover:opacity-100 transition-all duration-700 select-none">
                            {{ $term['id'] }}
                        </span>
                    </div>
                    <div class="space-y-8 flex-grow">
                        <h4 class="text-2xl font-black uppercase tracking-widest text-zinc-900 dark:text-white group-hover:text-amber-500 transition-colors duration-500">
                            {{ $term['title'] }}
                        </h4>
                        <div class="flex flex-wrap gap-3">
                            @foreach($term['tags'] as $tag)
                                <span class="px-4 py-1.5 rounded-full bg-zinc-100 dark:bg-white/5 border border-zinc-200 dark:border-white/5 text-[8px] font-black uppercase tracking-widest text-zinc-500">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <p class="text-zinc-500 dark:text-zinc-400 text-lg leading-relaxed font-light text-justify italic">
                            {{ $term['content'] }}
                        </p>
                    </div>
                </div>
            </section>
            @endforeach

            
            <div class="pt-40 text-center reveal-content">
                <div class="p-12 rounded-[3rem] bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 backdrop-blur-md">
                    <p class="text-zinc-400 text-[10px] font-black uppercase tracking-[0.4em] mb-10">Giải đáp chuyên sâu</p>
                    <div class="flex flex-col md:flex-row justify-center gap-6">
                        <a href="{{ route('pages.faq') }}" class="px-12 py-5 rounded-full bg-zinc-900 dark:bg-white text-white dark:text-black text-[9px] font-black uppercase tracking-widest hover:scale-105 transition-all shadow-2xl">Hỗ trợ Concierge</a>
                        <a href="mailto:legal@thiuu.rental" class="px-12 py-5 rounded-full border border-zinc-200 dark:border-white/10 text-[9px] font-black uppercase tracking-widest hover:bg-amber-500 hover:text-black hover:border-amber-500 transition-all">Gửi yêu cầu pháp lý</a>
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
            delay: 300
        })
        .add({
            targets: '.reveal-content',
            opacity: [0, 1],
            translateY: [30, 0],
            delay: anime.stagger(300),
            duration: 1500,
            offset: '-=800'
        });

        
        window.addEventListener('scroll', () => {
            const h = document.documentElement, 
                  b = document.body,
                  st = 'scrollTop',
                  sh = 'scrollHeight';
            const percent = (h[st]||b[st]) / ((h[sh]||b[sh]) - h.clientHeight) * 100;
            document.getElementById('scroll-progress').style.width = percent + '%';
        });
    });
</script>

<style>
    
    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-thumb { background: #eab308; border-radius: 10px; }
    
    .reveal-content, .reveal-header { will-change: transform, opacity; }
</style>
@endsection