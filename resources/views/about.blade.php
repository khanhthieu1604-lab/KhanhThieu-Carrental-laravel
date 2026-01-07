@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.29/bundled/lenis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>


<link href="https://fonts.googleapis.com/css2?family=Italiana&family=Manrope:wght@200;400;600&family=Syncopate:wght@400;700&display=swap" rel="stylesheet">

<style>
    :root {
        --c-gold: #C5A059;
        --c-black: #080808;
        --c-dark: #020202;
    }

    body { background-color: var(--c-black); cursor: none;  }
    
    
    .font-serif-display { font-family: 'Italiana', serif; }
    .font-sans-display { font-family: 'Manrope', sans-serif; }
    .font-future { font-family: 'Syncopate', sans-serif; letter-spacing: 0.2em; text-transform: uppercase; }

    
    .cursor-dot, .cursor-circle {
        position: fixed; top: 0; left: 0; transform: translate(-50%, -50%); border-radius: 50%; pointer-events: none; z-index: 9999;
    }
    .cursor-dot { width: 8px; height: 8px; background: white; }
    .cursor-circle { 
        width: 60px; height: 60px; border: 1px solid rgba(255, 255, 255, 0.2); 
        transition: width 0.3s, height 0.3s, background-color 0.3s;
    }
    body:hover .cursor-circle { width: 40px; height: 40px; } 

    
    .noise-wrapper {
        position: fixed; inset: 0; pointer-events: none; z-index: 50; opacity: 0.07;
        background: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
    }

    
    .scroll-line { position: fixed; right: 40px; top: 50%; transform: translateY(-50%); height: 200px; width: 1px; background: rgba(255,255,255,0.1); z-index: 40; }
    .scroll-fill { width: 100%; background: var(--c-gold); height: 0%; transition: height 0.1s; box-shadow: 0 0 10px var(--c-gold); }

    
    .mask-reveal {
        clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
        transition: clip-path 1.5s cubic-bezier(0.77, 0, 0.175, 1);
    }
    .mask-reveal.active { clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%); }

    
    .text-reveal-line { overflow: hidden; display: block; }
    .text-reveal-line span { display: block; transform: translateY(100%); transition: transform 1.2s cubic-bezier(0.19, 1, 0.22, 1); }
    .active .text-reveal-line span { transform: translateY(0); }

    
    .glow-card {
        background: rgba(255,255,255,0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.05);
        transition: all 0.5s;
    }
    .glow-card:hover { border-color: var(--c-gold); box-shadow: 0 0 30px rgba(197, 160, 89, 0.1); transform: translateY(-10px); }
</style>


<div class="cursor-dot hidden md:block"></div>
<div class="cursor-circle hidden md:block"></div>
<div class="noise-wrapper"></div>
<div class="scroll-line hidden md:block"><div class="scroll-fill"></div></div>

<div class="bg-[#020202] text-[#f0f0f0] min-h-screen font-sans-display overflow-x-hidden selection:bg-[#C5A059] selection:text-black">

    
    <section class="h-screen relative flex items-center justify-center overflow-hidden" data-cursor="-exclusion">
        <div class="absolute inset-0 z-0">
            <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-30 grayscale scale-110 parallax-bg">
                <source src="https://videos.pexels.com/video-files/3206132/3206132-uhd_2560_1440_25fps.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-t from-[#020202] via-transparent to-[#020202]"></div>
        </div>

        <div class="relative z-10 text-center mix-blend-difference">
            <div class="overflow-hidden mb-6">
                <p class="font-future text-xs md:text-sm tracking-[0.5em] text-[#C5A059] hero-anim translate-y-full">Since 1910</p>
            </div>
            <h1 class="font-serif-display text-8xl md:text-[12rem] leading-[0.85] uppercase tracking-tight mb-8">
                <div class="text-reveal-line"><span>The House</span></div>
                <div class="text-reveal-line"><span class="italic text-[#C5A059]">Of Thiuu</span></div>
            </h1>
            <div class="max-w-xl mx-auto overflow-hidden">
                <p class="text-white/70 text-lg md:text-xl font-light hero-anim translate-y-full delay-100">
                    Nơi di sản trăm năm gặp gỡ công nghệ tương lai.
                </p>
            </div>
        </div>
    </section>

    
    <div class="relative py-40 border-t border-white/5">
        <div class="container mx-auto px-6">
            
            
            <div class="flex flex-col md:flex-row items-center gap-20 mb-60 scroll-section">
                <div class="md:w-1/2 relative">
                    <span class="absolute -left-20 -top-20 text-[15rem] font-serif-display text-white/5 select-none z-0">01</span>
                    <div class="relative z-10 mask-reveal w-full aspect-[4/5]">
                        <img src="https://images.unsplash.com/photo-1583267597475-430972322312?q=80&w=1000" class="w-full h-full object-cover grayscale sepia-[0.5]">
                        <div class="absolute inset-0 bg-black/20 hover:bg-transparent transition-colors duration-700"></div>
                    </div>
                </div>
                <div class="md:w-1/2 pl-0 md:pl-20 text-reveal-trigger">
                    <span class="text-[#C5A059] font-future text-xs mb-4 block">Chapter I — Indochina</span>
                    <h2 class="text-6xl font-serif-display mb-8">1910: Sự Tĩnh Lặng</h2>
                    <p class="text-zinc-400 text-lg leading-relaxed mb-8">
                        Trong thời đại của tiếng ồn, cụ cố Khanh Thiuu đã thiết lập một tiêu chuẩn vàng: <strong class="text-white">"Sự sang trọng thực sự không cần phải lên tiếng."</strong> Những cỗ xe ngựa đầu tiên của Thiuu Transport lướt đi trong đêm Sài Gòn, chở những vị khách quyền lực nhất, với những người đánh xe đã thề giữ bí mật tuyệt đối.
                    </p>
                    <div class="w-20 h-[1px] bg-[#C5A059]"></div>
                </div>
            </div>

            
            <div class="flex flex-col md:flex-row-reverse items-center gap-20 mb-60 scroll-section">
                <div class="md:w-1/2 relative">
                    <span class="absolute -right-20 -top-20 text-[15rem] font-serif-display text-white/5 select-none z-0">02</span>
                    <div class="relative z-10 mask-reveal w-full aspect-[4/5]">
                        <img src="https://images.unsplash.com/photo-1549522199-6332d99b7948?q=80&w=1000" class="w-full h-full object-cover grayscale contrast-125">
                    </div>
                </div>
                <div class="md:w-1/2 pr-0 md:pr-20 text-reveal-trigger">
                    <span class="text-[#C5A059] font-future text-xs mb-4 block">Chapter II — The Glamour</span>
                    <h2 class="text-6xl font-serif-display mb-8">1980: Kỷ Nguyên Vàng</h2>
                    <p class="text-zinc-400 text-lg leading-relaxed mb-8">
                        Thiuu Rental đưa về những chiếc Rolls-Royce Silver Spirit đầu tiên. Chúng tôi không chỉ cung cấp xe, chúng tôi cung cấp "phụ kiện" cho sự quyền lực. Mỗi chiếc xe là một tác phẩm nghệ thuật, mỗi hành trình là một màn trình diễn trên sân khấu đô thị.
                    </p>
                    <div class="w-20 h-[1px] bg-[#C5A059]"></div>
                </div>
            </div>

            
            <div class="flex flex-col md:flex-row items-center gap-20 scroll-section">
                <div class="md:w-1/2 relative">
                    <span class="absolute -left-20 -top-20 text-[15rem] font-serif-display text-white/5 select-none z-0">03</span>
                    <div class="relative z-10 mask-reveal w-full aspect-video">
                        <img src="https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?q=80&w=1200" class="w-full h-full object-cover">
                        
                        <div class="absolute inset-0 border border-white/10 m-4">
                            <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-[#C5A059]"></div>
                            <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-[#C5A059]"></div>
                            <span class="absolute bottom-4 left-4 font-future text-[10px] text-[#C5A059]">System: Active</span>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 pl-0 md:pl-20 text-reveal-trigger">
                    <span class="text-[#C5A059] font-future text-xs mb-4 block">Chapter III — Digital Empire</span>
                    <h2 class="text-6xl font-serif-display mb-8">2026: Đế Chế Số</h2>
                    <p class="text-zinc-400 text-lg leading-relaxed mb-8">
                        Tôi là thế hệ thứ tư. Tôi đã mã hóa di sản gia tộc vào từng dòng code. Ứng dụng <strong class="text-white">Thiuu Elite</strong> cho phép bạn triệu hồi 500 siêu xe chỉ với một cú chạm. Nhưng linh hồn phục vụ vẫn vẹn nguyên: Kín đáo, Tận tụy và Đẳng cấp.
                    </p>
                    <div class="flex gap-8 mt-12">
                        <div><span class="text-4xl font-serif-display text-white block">500+</span><span class="text-xs text-zinc-500 uppercase">Supercars</span></div>
                        <div><span class="text-4xl font-serif-display text-white block">24/7</span><span class="text-xs text-zinc-500 uppercase">Support</span></div>
                        <div><span class="text-4xl font-serif-display text-white block">0s</span><span class="text-xs text-zinc-500 uppercase">Delay</span></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    
    <section class="py-40 bg-[#080808]">
        <div class="container mx-auto px-6">
            <h2 class="text-center font-serif-display text-4xl text-zinc-600 mb-20">The <span class="text-white italic">Thiuu Standard</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach(['Omotenashi' => 'Sự hiếu khách tận tâm của Nhật Bản, dự đoán nhu cầu trước khi khách hàng lên tiếng.', 'Bespoke' => 'Mỗi hành trình là độc bản. Xe, nhạc, nhiệt độ, mùi hương - tất cả đều được cá nhân hóa.', 'Privacy' => 'Bảo mật danh tính khách hàng là tôn chỉ tối thượng. Những gì xảy ra trên xe, ở lại trên xe.'] as $title => $desc)
                <div class="glow-card p-10 rounded-2xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-20 group-hover:opacity-100 transition-opacity">
                        <i class="fa-solid fa-star text-[#C5A059]"></i>
                    </div>
                    <h3 class="text-2xl font-future text-white mb-6 group-hover:text-[#C5A059] transition-colors">{{ $title }}</h3>
                    <p class="text-zinc-400 font-light leading-relaxed">{{ $desc }}</p>
                    <div class="w-full h-[1px] bg-white/10 mt-8 group-hover:bg-[#C5A059] transition-colors"></div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    
    <section class="h-screen relative flex items-center justify-center bg-black overflow-hidden perspective-1000">
        
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[50vw] h-[50vw] bg-[#C5A059] rounded-full blur-[150px] opacity-10 animate-pulse"></div>

        <div class="relative z-10 text-center">
            <p class="font-future text-zinc-500 text-xs mb-10 tracking-widest">You have reached the end</p>
            
            
            <div class="card-3d-wrapper perspective-1000 inline-block">
                <a href="{{ route('vehicles.index') }}" class="card-3d block relative w-[350px] h-[500px] bg-[#0f0f0f] border border-[#C5A059]/30 rounded-xl overflow-hidden group cursor-none">
                    
                    
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-8 z-20">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/f8/Stylized_uw_crown.svg" class="w-16 h-16 invert opacity-80 mb-8 group-hover:scale-110 transition-transform duration-500">
                        <h3 class="font-serif-display text-4xl text-[#C5A059] mb-2">Thiuu Elite</h3>
                        <p class="text-zinc-500 text-xs uppercase tracking-[0.3em] mb-12">Membership Invitation</p>
                        
                        <div class="w-full h-px bg-gradient-to-r from-transparent via-[#C5A059] to-transparent mb-8"></div>
                        
                        <p class="font-sans-display text-white text-sm tracking-widest uppercase group-hover:text-[#C5A059] transition-colors">Click to Enter</p>
                    </div>

                    
                    <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/10 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000 z-30"></div>
                    
                    
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/leather.png')] opacity-30 z-0"></div>
                </a>
            </div>

            <p class="mt-12 font-serif-display italic text-zinc-600">"Only for those who dare."</p>
        </div>
    </section>

</div>

<script>
    
    const lenis = new Lenis({ duration: 1.5, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    function raf(time) { lenis.raf(time); requestAnimationFrame(raf); }
    requestAnimationFrame(raf);

    
    const cursorDot = document.querySelector('.cursor-dot');
    const cursorCircle = document.querySelector('.cursor-circle');
    
    document.addEventListener('mousemove', (e) => {
        cursorDot.style.left = e.clientX + 'px';
        cursorDot.style.top = e.clientY + 'px';
        
        
        cursorCircle.animate({
            left: e.clientX + 'px',
            top: e.clientY + 'px'
        }, { duration: 500, fill: "forwards" });
    });

    
    gsap.registerPlugin(ScrollTrigger);

    
    gsap.utils.toArray('.text-reveal-line span').forEach((span, i) => {
        gsap.to(span, {
            y: 0, opacity: 1, duration: 1.5, ease: "power4.out", delay: 0.2 + (i * 0.1)
        });
    });
    
    gsap.to('.hero-anim', { y: 0, opacity: 1, duration: 1.5, ease: "power4.out", delay: 1, stagger: 0.2 });

    
    window.addEventListener('scroll', () => {
        const scrollPercent = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
        document.querySelector('.scroll-fill').style.height = scrollPercent + '%';
    });

    
    const revealSections = document.querySelectorAll('.scroll-section');
    revealSections.forEach(section => {
        
        ScrollTrigger.create({
            trigger: section,
            start: "top 70%",
            onEnter: () => section.querySelector('.mask-reveal').classList.add('active')
        });

        
        gsap.fromTo(section.querySelector('.text-reveal-trigger'), 
            { y: 50, opacity: 0 },
            { y: 0, opacity: 1, duration: 1.5, ease: "power3.out", scrollTrigger: { trigger: section, start: "top 60%" } }
        );
    });

    
    const card = document.querySelector('.card-3d');
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const rotateX = ((y - centerY) / centerY) * -10; 
        const rotateY = ((x - centerX) / centerX) * 10;

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1)`;
    });
</script>
@endsection