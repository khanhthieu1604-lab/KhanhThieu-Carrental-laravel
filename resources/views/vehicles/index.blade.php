@extends('layouts.app')

@section('content')


<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.29/bundled/lenis.min.js"></script>

<style>
    
    .bg-noise {
        position: fixed; inset: 0; z-index: 0; pointer-events: none; opacity: 0.05;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
    }

    
    .vehicle-card {
        --mouse-x: 50%; --mouse-y: 50%;
        position: relative;
    }
    .vehicle-card::before { 
        content: ""; position: absolute; inset: 0; border-radius: 2rem; padding: 1px;
        background: radial-gradient(800px circle at var(--mouse-x) var(--mouse-y), rgba(234, 179, 8, 0.4), transparent 40%);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask-composite: exclude; -webkit-mask-composite: destination-out;
        pointer-events: none; z-index: 30; opacity: 0; transition: opacity 0.5s;
    }
    .vehicle-card:hover::before { opacity: 1; }

    
    .filter-bar.scrolled {
        transform: translateY(-20px) scale(0.95);
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
        border: 1px solid rgba(234, 179, 8, 0.3);
    }
    .dark .filter-bar.scrolled { background: rgba(10, 10, 10, 0.95); border-color: rgba(234, 179, 8, 0.2); }

    
    .char-reveal { display: inline-block; transform: translateY(100%); opacity: 0; transition: all 0.5s ease; }
    .char-reveal.visible { transform: translateY(0); opacity: 1; }
</style>

<div class="bg-gray-50 dark:bg-[#050505] min-h-screen relative font-sans overflow-x-hidden selection:bg-yellow-500 selection:text-black">
    <div class="bg-noise"></div>

    
    <div class="relative h-[60vh] flex items-center justify-center overflow-hidden group">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1494905998402-395d579af9c5?q=80&w=2070" 
                 class="w-full h-full object-cover opacity-80 scale-110 parallax-bg transition-transform duration-700 ease-out" 
                 alt="Fleet Banner">
            <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/20 to-gray-50 dark:to-[#050505]"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl header-anim">
            <span class="inline-block py-1.5 px-5 rounded-full border border-yellow-500/50 bg-black/30 backdrop-blur-md text-yellow-400 text-[10px] font-black uppercase tracking-[0.4em] mb-6 animate-pulse">
                The Royal Fleet
            </span>
            <h1 class="text-6xl md:text-8xl font-black text-white mb-6 tracking-tighter drop-shadow-2xl">
                <span class="block overflow-hidden"><span class="block translate-y-full title-char">Ultimate</span></span>
                <span class="block overflow-hidden"><span class="block translate-y-full title-char text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-amber-600">Machine</span></span>
            </h1>
        </div>
    </div>

    
    <div class="relative z-20 -mt-20 pb-20">
        <div class="container mx-auto px-4">
            
            
            <div class="filter-bar bg-white/80 dark:bg-[#121212]/80 backdrop-blur-xl p-4 rounded-[2rem] shadow-2xl border border-white/20 dark:border-white/5 transition-all duration-500 ease-out sticky top-6 z-50">
                <form action="{{ route('vehicles.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                    
                    <div class="md:col-span-4 relative group">
                        <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-yellow-500 transition-colors"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm tên siêu xe..." 
                               class="w-full pl-12 pr-4 py-3.5 bg-gray-100 dark:bg-black/50 border-none rounded-xl text-sm font-bold text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-yellow-500 transition-all hover:bg-white dark:hover:bg-black/70">
                    </div>

                    
                    <div class="md:col-span-3">
                        <select name="category" class="w-full px-5 py-3.5 bg-gray-100 dark:bg-black/50 border-none rounded-xl text-sm font-bold text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 cursor-pointer hover:bg-white dark:hover:bg-black/70 transition-colors">
                            <option value="">Tất cả phân khúc</option>
                            <option value="Sedan" {{ request('category') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                            <option value="SUV" {{ request('category') == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="Coupe" {{ request('category') == 'Coupe' ? 'selected' : '' }}>Coupe</option>
                        </select>
                    </div>

                    <div class="md:col-span-3">
                        <select name="price" class="w-full px-5 py-3.5 bg-gray-100 dark:bg-black/50 border-none rounded-xl text-sm font-bold text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 cursor-pointer hover:bg-white dark:hover:bg-black/70 transition-colors">
                            <option value="">Mức giá</option>
                            <option value="under_1m" {{ request('price') == 'under_1m' ? 'selected' : '' }}>&lt; 1 Triệu</option>
                            <option value="above_2m" {{ request('price') == 'above_2m' ? 'selected' : '' }}>&gt; 2 Triệu</option>
                        </select>
                    </div>

                    
                    <div class="md:col-span-2">
                        <button type="submit" class="w-full py-3.5 bg-yellow-500 text-black font-black uppercase text-xs rounded-xl shadow-lg shadow-yellow-500/20 relative overflow-hidden group hover:scale-105 transition-transform active:scale-95">
                            <span class="relative z-10 group-hover:text-white transition-colors">Tìm Kiếm</span>
                            <div class="absolute inset-0 bg-black scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300 ease-out"></div>
                        </button>
                    </div>
                </form>
            </div>

            
            @if(isset($vehicles) && $vehicles->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12 perspective-1000" id="vehicle-grid">
                    @foreach($vehicles as $index => $vehicle)
                        <div class="vehicle-card group relative h-full rounded-[2rem] bg-white dark:bg-[#0f0f0f] border border-gray-200 dark:border-white/5 overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl" style="opacity: 0; animation: fadeInUp 0.8s ease forwards {{ $index * 0.1 }}s;">
                            
                            
                            <div class="relative h-60 overflow-hidden">
                                <img src="{{ str_starts_with($vehicle->image, 'http') ? $vehicle->image : asset('storage/' . $vehicle->image) }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     onerror="this.src='https://placehold.co/600x400/1a1a1a/666?text=Car+Image'">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                                
                                
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-black/60 backdrop-blur-md border border-white/10 rounded-full text-[10px] font-bold text-white uppercase tracking-wider">
                                        {{ $vehicle->brand->name ?? 'Elite' }}
                                    </span>
                                </div>
                                
                                
                                <button class="absolute top-4 right-4 w-8 h-8 bg-white/10 backdrop-blur rounded-full flex items-center justify-center text-white hover:bg-red-500 hover:text-white transition-colors">
                                    <i class="fa-regular fa-heart text-xs"></i>
                                </button>
                            </div>

                            
                            <div class="p-6">
                                <h3 class="text-lg font-black text-gray-900 dark:text-white mb-1 truncate group-hover:text-yellow-500 transition-colors">{{ $vehicle->name }}</h3>
                                
                                
                                <div class="flex gap-3 text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-6">
                                    <span class="flex items-center gap-1"><i class="fa-solid fa-gas-pump text-yellow-500"></i> Xăng</span>
                                    <span class="flex items-center gap-1"><i class="fa-solid fa-gears text-yellow-500"></i> Auto</span>
                                    <span class="flex items-center gap-1"><i class="fa-solid fa-user text-yellow-500"></i> 4</span>
                                </div>

                                
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-white/5">
                                    <div>
                                        <span class="text-xl font-black text-gray-900 dark:text-white">{{ number_format($vehicle->price/1000, 0) }}k</span>
                                        <span class="text-[10px] text-gray-400 font-bold">/NGÀY</span>
                                    </div>
                                    <a href="{{ route('vehicles.show', $vehicle->id) }}" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-white/10 flex items-center justify-center text-gray-900 dark:text-white group-hover:bg-yellow-500 group-hover:text-black transition-all duration-300">
                                        <i class="fa-solid fa-arrow-right -rotate-45 group-hover:rotate-0 transition-transform"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                
                <div class="mt-20 flex justify-center">
                    <div class="bg-white dark:bg-[#121212] rounded-2xl shadow-lg px-6 py-2 border border-gray-100 dark:border-gray-800">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            @else
                <div class="py-32 text-center">
                    <div class="inline-block p-6 rounded-full bg-gray-100 dark:bg-white/5 mb-4">
                        <i class="fa-solid fa-car-tunnel text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Chưa tìm thấy xe</h3>
                    <p class="text-gray-500 text-sm">Hãy thử thay đổi bộ lọc hoặc tìm kiếm từ khóa khác.</p>
                </div>
            @endif
        </div>
    </div>
</div>


<script>
    
    const lenis = new Lenis({ duration: 1.2, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    function raf(time) { lenis.raf(time); requestAnimationFrame(raf); }
    requestAnimationFrame(raf);

    document.addEventListener('DOMContentLoaded', () => {
        
        const parallaxBg = document.querySelector('.parallax-bg');
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            if (parallaxBg) {
                parallaxBg.style.transform = `scale(1.1) translateY(${scrollY * 0.5}px)`;
            }
            
            
            const filterBar = document.querySelector('.filter-bar');
            if (scrollY > 100) {
                filterBar.classList.add('scrolled');
            } else {
                filterBar.classList.remove('scrolled');
            }
        });

        
        anime.timeline({ easing: 'easeOutExpo' })
             .add({ targets: '.title-char', translateY: ['100%', '0%'], duration: 1200, delay: anime.stagger(100) })
             .add({ targets: '.header-anim', opacity: [0, 1], translateY: [20, 0], duration: 1000 }, '-=800');

        
        const cards = document.querySelectorAll('.vehicle-card');
        document.getElementById('vehicle-grid').onmousemove = e => {
            for(const card of cards) {
                const rect = card.getBoundingClientRect(),
                      x = e.clientX - rect.left,
                      y = e.clientY - rect.top;
                card.style.setProperty("--mouse-x", `${x}px`);
                card.style.setProperty("--mouse-y", `${y}px`);
            };
        };
    });
</script>

<style>
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .perspective-1000 { perspective: 1000px; }
</style>

@endsection