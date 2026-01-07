@php
    $isAdmin = Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'master');
    // Hiệu ứng kính mờ đặc trưng Luxury
    $navClass = 'bg-white/70 dark:bg-[#050505]/70 backdrop-blur-xl border-b border-gray-100/50 dark:border-white/5';
@endphp


<nav x-data="{ 
    open: false, 
    darkMode: localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
    toggleDark() {
        this.darkMode = !this.darkMode;
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }
    }
}" 
id="main-nav" class="{{ $navClass }} sticky top-0 z-[100] transition-all duration-500">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <div class="flex items-center">
                
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="group flex items-center gap-2">
                        <span class="font-black text-2xl tracking-tighter text-gray-900 dark:text-white group-hover:text-yellow-600 transition-colors duration-500">
                            THIUU<span class="text-yellow-500 italic opacity-50 group-hover:opacity-100">.</span>
                        </span>
                    </a>
                </div>

                
                <div class="hidden space-x-2 sm:-my-px sm:ms-12 sm:flex items-center">
                    @php
                        $links = [
                            ['route' => 'home', 'label' => $isAdmin ? 'Bảng điều khiển' : 'Trang chủ', 'active' => request()->routeIs('home') || request()->routeIs('admin.dashboard')],
                            ['route' => 'about', 'label' => 'Về chúng tôi', 'active' => request()->routeIs('about')],
                            ['route' => $isAdmin ? 'admin.vehicles.index' : 'vehicles.index', 'label' => $isAdmin ? 'Quản lý đội xe' : 'Siêu xe', 'active' => request()->routeIs('vehicles.*') || request()->routeIs('admin.vehicles.*')],
                            ['route' => 'services', 'label' => $isAdmin ? 'Đánh giá' : 'Dịch vụ', 'active' => request()->routeIs('services')],
                        ];
                    @endphp

                    @foreach($links as $link)
                        <a href="{{ route($link['route']) }}" 
                           class="relative px-4 py-2 text-[10px] font-black uppercase tracking-[0.3em] transition-all duration-500 group
                           {{ $link['active'] ? 'text-yellow-600 dark:text-yellow-500' : 'text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                            {{ $link['label'] }}
                            <span class="absolute bottom-0 left-4 right-4 h-[1px] bg-yellow-500 origin-left scale-x-0 transition-transform duration-500 group-hover:scale-x-100 {{ $link['active'] ? 'scale-x-100' : '' }}"></span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-6">
                
                <button @click="toggleDark()"
                        type="button" 
                        id="theme-toggle"
                        class="w-10 h-10 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 rounded-xl transition-all duration-200 active:scale-90">
                    
                    
                    <span x-show="!darkMode" x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100">
                        <i class="fa-solid fa-moon text-sm"></i>
                    </span>
                    
                    
                    <span x-show="darkMode" x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100" x-cloak>
                        <i class="fa-solid fa-sun text-sm text-yellow-500"></i>
                    </span>
                </button>

                @auth
                    
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-3 group">
                                <div class="w-8 h-8 rounded-full bg-gray-900 dark:bg-white flex items-center justify-center text-[10px] font-black text-white dark:text-black transition-transform group-hover:scale-110 shadow-sm">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="hidden lg:block text-left">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="py-2 bg-white dark:bg-[#0a0a0a]">
                                <x-dropdown-link :href="route('profile.edit')" class="text-[10px] font-black uppercase tracking-widest py-3">Hồ sơ cá nhân</x-dropdown-link>
                                <x-dropdown-link :href="route('bookings.history')" class="text-[10px] font-black uppercase tracking-widest py-3">Lịch sử thuê</x-dropdown-link>
                                @if($isAdmin)
                                    <div class="border-t border-gray-100 dark:border-white/5 mx-4 my-1"></div>
                                    <x-dropdown-link :href="route('admin.dashboard')" class="text-[10px] font-black uppercase tracking-widest py-3 text-amber-500">Quản trị hệ thống</x-dropdown-link>
                                @endif
                                <div class="border-t border-gray-100 dark:border-white/5 mx-4 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" class="text-[10px] font-black uppercase tracking-widest py-3 text-red-500" onclick="event.preventDefault(); this.closest('form').submit();">Đăng xuất</x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-900 dark:text-white border-b border-yellow-500/50 pb-0.5 hover:border-yellow-500 transition-all">Hội viên</a>
                @endauth

                
                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open" class="text-gray-400 hover:text-white transition">
                        <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8h16M4 16h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="sm:hidden bg-white dark:bg-[#0a0a0a] border-t border-gray-100 dark:border-white/5 shadow-2xl">
        <div class="px-6 py-8 space-y-6 text-center">
            @foreach($links as $link)
                <a href="{{ route($link['route']) }}" class="block text-[10px] font-black uppercase tracking-[0.3em] text-gray-600 dark:text-gray-400 hover:text-yellow-500">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nav = document.getElementById('main-nav');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 20) {
                nav.classList.add('shadow-xl', 'dark:bg-[#050505]/95');
            } else {
                nav.classList.remove('shadow-xl', 'dark:bg-[#050505]/95');
            }

            if (currentScroll > lastScroll && currentScroll > 200) {
                nav.style.transform = 'translateY(-100%)';
            } else {
                nav.style.transform = 'translateY(0)';
            }
            lastScroll = currentScroll;
        }, { passive: true });
    });
</script>

<style>
    [x-cloak] { display: none !important; }
    #main-nav {
        will-change: transform, background-color;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), background 0.3s ease;
    }
</style>