@extends('layouts.app')

@section('content')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<style>
    
    .font-display { font-family: 'Montserrat', sans-serif; letter-spacing: -0.03em; }
    
    
    .fixed-bg {
        position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
        z-index: -1; pointer-events: none; overflow: hidden;
    }
    
   
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .reveal-active { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    
   
    .letter-reveal { display: inline-block; opacity: 0; }
    
   
    @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .animate-scroll { animation: scroll 40s linear infinite; }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    .animate-float { animation: float 6s ease-in-out infinite; }

    
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #eab308; border-radius: 4px; }

    
    .glass-panel {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    }
</style>


<div class="fixed-bg bg-zinc-50 dark:bg-[#050505] transition-colors duration-500">
    
    <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/stardust.png');"></div>
    
    
    <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] bg-yellow-500/10 rounded-full blur-[120px] animate-float"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] bg-blue-600/10 rounded-full blur-[120px] animate-float" style="animation-delay: 2s;"></div>
</div>

<div class="min-h-screen text-zinc-900 dark:text-white font-sans relative z-10 overflow-x-hidden">

    
    <div class="relative h-screen w-full flex flex-col justify-center items-center">
        
        
        <div class="absolute inset-0 z-0">
            <div class="swiper heroSwiper w-full h-full">
                <div class="swiper-wrapper">
                    @foreach([
                        'https://images.unsplash.com/photo-1503376763036-066120622c74?q=80&w=2070',
                        'https://images.unsplash.com/photo-1617788138017-80ad40651399?q=80&w=2070',
                        'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=2070'
                    ] as $img)
                    <div class="swiper-slide h-full"> 
                        <img src="{{ $img }}" class="w-full h-full object-cover brightness-[0.4]">
                    </div>
                    @endforeach
                </div>
            </div>
           
            <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-transparent to-black/30"></div>
        </div>

        
        <div class="z-10 text-center px-4 w-full max-w-6xl mt-[-60px]">
            <div class="mb-12">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-yellow-500/30 bg-black/20 backdrop-blur-md mb-6 reveal-active">
                    <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                    <span class="text-[10px] font-bold text-yellow-500 uppercase tracking-[0.3em]">Thiuu Rental Elite</span>
                </div>
                
                <h1 class="font-display text-6xl md:text-[9rem] font-black text-white leading-[0.9] tracking-tighter mb-6 ml3">
                    THIU <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-amber-600">RENTAL</span>
                </h1>
                
                <p class="text-zinc-300 text-sm md:text-lg max-w-2xl mx-auto font-light tracking-widest reveal-active" style="animation-delay: 0.3s;">
                    Trải nghiệm dịch vụ thuê xe thượng lưu với công nghệ định danh bảo mật tuyệt đối.
                </p>
            </div>

           
            <div class="glass-panel p-3 rounded-[3rem] reveal-active relative z-50 shadow-2xl" style="animation-delay: 0.5s;">
                <form action="{{ route('vehicles.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-2">
                    
                    
                    <div class="md:col-span-5 bg-white/10 rounded-[2.5rem] px-8 py-4 relative group hover:bg-white/20 transition-colors">
                        <label class="text-[9px] font-bold text-yellow-500 uppercase tracking-widest block mb-1">Pick-up Location</label>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-location-dot text-zinc-400"></i>
                            <input type="text" id="goong-input" name="location" placeholder="Bạn muốn nhận xe ở đâu?" autocomplete="off"
                                   class="w-full bg-transparent border-none p-0 text-sm font-bold text-white placeholder-zinc-500 focus:ring-0">
                        </div>
                       
                        <div id="goong-results" class="absolute left-0 top-[110%] w-full bg-[#151515] border border-white/10 rounded-3xl shadow-2xl hidden z-50 overflow-hidden">
                            <ul id="results-list" class="max-h-60 overflow-y-auto custom-scrollbar text-left py-2 text-white"></ul>
                        </div>
                    </div>

                   
                    <div class="md:col-span-3 bg-white/10 rounded-[2.5rem] px-8 py-4 hover:bg-white/20 transition-colors">
                        <label class="text-[9px] font-bold text-yellow-500 uppercase tracking-widest block mb-1">Start Date</label>
                        <input type="datetime-local" name="start_date" class="w-full bg-transparent border-none p-0 text-xs font-bold text-white focus:ring-0" style="color-scheme: dark;">
                    </div>
                    <div class="md:col-span-3 bg-white/10 rounded-[2.5rem] px-8 py-4 hover:bg-white/20 transition-colors">
                        <label class="text-[9px] font-bold text-yellow-500 uppercase tracking-widest block mb-1">End Date</label>
                        <input type="datetime-local" name="end_date" class="w-full bg-transparent border-none p-0 text-xs font-bold text-white focus:ring-0" style="color-scheme: dark;">
                    </div>

                 
                    <div class="md:col-span-1">
                        <button type="submit" class="w-full h-full bg-yellow-500 hover:bg-yellow-400 text-black rounded-[2.5rem] flex items-center justify-center transition-transform active:scale-95 shadow-[0_0_20px_rgba(234,179,8,0.4)]">
                            <i class="fa-solid fa-arrow-right text-xl"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   
    <div class="bg-black border-y border-white/10 py-10 marquee-container overflow-hidden">
        <div class="flex animate-scroll whitespace-nowrap gap-24 w-max items-center">
            @foreach(array_merge(['ROLLS-ROYCE', 'BENTLEY', 'PORSCHE', 'FERRARI', 'LAMBORGHINI', 'MCLAREN'], ['ROLLS-ROYCE', 'BENTLEY', 'PORSCHE', 'FERRARI', 'LAMBORGHINI', 'MCLAREN']) as $brand)
                <span class="text-6xl font-black italic text-transparent px-4 stroke-text cursor-default opacity-30 hover:opacity-100 transition-opacity" 
                      style="-webkit-text-stroke: 1px rgba(255,255,255,0.5);">
                    {{ $brand }}
                </span>
            @endforeach
        </div>
    </div>

    
    <section class="py-20 px-6 container mx-auto">
        <div class="relative rounded-[3rem] overflow-hidden h-[500px] group">
            <img src="https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?q=80&w=2070" class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-transparent flex flex-col justify-center px-12 md:px-24">
                <span class="text-yellow-500 font-bold text-xs uppercase tracking-[0.4em] mb-4">Limited Edition</span>
                <h2 class="text-5xl md:text-7xl font-black text-white uppercase mb-8 leading-none">Drive The <br> Impossible</h2>
                <a href="{{ route('vehicles.index') }}" class="inline-flex items-center gap-4 px-8 py-4 bg-white text-black rounded-full w-fit font-black uppercase tracking-widest hover:bg-yellow-500 transition-colors">
                    Khám phá ngay <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    
    <section class="py-20 px-6 container mx-auto">
        <div class="flex justify-between items-end mb-16">
            <div>
                <h2 class="text-5xl md:text-7xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter">The <span class="text-yellow-500">Collection</span></h2>
            </div>
            <a href="{{ route('vehicles.index') }}" class="hidden md:flex items-center gap-3 px-8 py-4 rounded-full border border-zinc-300 dark:border-white/20 hover:bg-zinc-900 hover:text-white dark:hover:bg-white dark:hover:text-black transition-all font-bold uppercase tracking-widest text-xs">
                Xem tất cả
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(isset($vehicles) && count($vehicles) > 0)
                @foreach($vehicles as $vehicle)
                    <div class="group relative bg-white dark:bg-[#111] rounded-[2.5rem] overflow-hidden border border-zinc-200 dark:border-white/10 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        
                        <div class="h-72 overflow-hidden relative">
                            <img src="{{ str_starts_with($vehicle->image, 'http') ? $vehicle->image : asset('storage/' . $vehicle->image) }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 onerror="this.src='https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=800'">
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 dark:bg-black/60 backdrop-blur-md rounded-full text-[10px] font-bold uppercase text-zinc-900 dark:text-white tracking-wider">
                                    {{ $vehicle->brand->name ?? 'Luxury' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-8">
                            <h3 class="text-2xl font-black text-zinc-900 dark:text-white uppercase mb-2 truncate">{{ $vehicle->name }}</h3>
                            <div class="flex justify-between items-center pt-4 border-t border-zinc-100 dark:border-white/5">
                                <p class="text-xl font-bold text-zinc-900 dark:text-white">{{ number_format($vehicle->price) }} <span class="text-xs text-zinc-500 font-normal">VND/ngày</span></p>
                                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center hover:bg-yellow-500 hover:text-white transition-all">
                                    <i class="fa-solid fa-arrow-right -rotate-45 group-hover:rotate-0 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full py-20 text-center glass-panel rounded-[2rem]">
                    <i class="fa-solid fa-car text-4xl text-zinc-500 mb-4"></i>
                    <p class="text-zinc-400">Showroom đang được cập nhật. <a href="/cuu-toi-di" class="text-yellow-500 underline">Nạp dữ liệu mẫu</a></p>
                </div>
            @endif
        </div>
    </section>

</div>


<script>
    
    function selectLoc(val) {
        document.getElementById('goong-input').value = val;
        document.getElementById('goong-results').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', () => {
       
        var textWrapper = document.querySelector('.ml3');
        if (textWrapper) {
            textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter-reveal'>$&</span>");
            anime.timeline({loop: false}).add({
                targets: '.ml3 .letter-reveal',
                opacity: [0,1],
                easing: "easeInOutQuad",
                duration: 1500,
                delay: (el, i) => 150 * (i+1)
            });
        }

        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal-active');
                    observer.unobserve(entry.target);
                }
            });
        });
        document.querySelectorAll('.reveal-active').forEach(el => {
            el.style.opacity = '0'; 
            observer.observe(el);
        });

        
        new Swiper(".heroSwiper", { effect: "fade", speed: 2000, autoplay: { delay: 5000 }, loop: true, allowTouchMove: false });

        
        const apiKey = "{{ env('GOONG_API_KEY') }}";
        const input = document.getElementById('goong-input');
        const resultsBox = document.getElementById('goong-results');
        const list = document.getElementById('results-list');
        let debounceTimeout;

        if (input) {
            input.addEventListener('input', (e) => {
                const query = e.target.value.trim();
                clearTimeout(debounceTimeout);
                if (query.length < 2) { resultsBox.classList.add('hidden'); return; }

                debounceTimeout = setTimeout(() => {
                   
                    console.log('Calling API with Key:', apiKey ? 'Loaded' : 'Missing');
                    
                    fetch(`https://rsapi.goong.io/Place/AutoComplete?api_key=${apiKey}&input=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.predictions && data.predictions.length > 0) {
                                list.innerHTML = data.predictions.map(p => `
                                    <li class="px-6 py-3 hover:bg-white/10 cursor-pointer transition-colors text-[11px] font-bold uppercase tracking-tight text-white border-b border-white/5 flex items-center gap-3"
                                        onclick="selectLoc('${p.description.replace(/'/g, "\\'")}')">
                                        <i class="fa-solid fa-map-pin opacity-50 text-yellow-500"></i> 
                                        <span>${p.description}</span>
                                    </li>
                                `).join('');
                                resultsBox.classList.remove('hidden');
                            } else { resultsBox.classList.add('hidden'); }
                        })
                        .catch(err => {
                            console.error(err);
                            resultsBox.classList.add('hidden');
                        });
                }, 300);
            });

            document.addEventListener('click', (e) => {
                if (!input.contains(e.target) && !resultsBox.contains(e.target)) resultsBox.classList.add('hidden');
            });
        }
    });
</script>

@endsection