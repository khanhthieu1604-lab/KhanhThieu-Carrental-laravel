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
    role="navigation"
    aria-label="Main navigation"
    id="main-nav"
    class="{{ $navClass }} sticky top-0 z-[100] transition-all duration-500">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Left Side: Logo + Menu Items + Action Buttons - All in one line -->
            <div class="flex items-center gap-8 flex-1">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="group flex items-center gap-2">
                        <span class="font-black text-2xl tracking-tighter text-gray-900 dark:text-white group-hover:text-yellow-600 transition-colors duration-500">
                            THIUU<span class="text-yellow-500 italic opacity-50 group-hover:opacity-100">.</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links - Desktop -->
                <div class="hidden lg:flex items-center gap-1">
                    @php
                    // DEBUG LOCALE
                    \Log::info('View Locale: ' . App::getLocale());
                    $links = [
                    ['route' => 'home', 'label' => $isAdmin ? 'Dashboard' : __('Home'), 'active' => request()->routeIs('home') || request()->routeIs('admin.dashboard')],
                    ['route' => 'about', 'label' => __('About Us'), 'active' => request()->routeIs('about')],
                    ['route' => $isAdmin ? 'admin.vehicles.index' : 'vehicles.index', 'label' => $isAdmin ? 'Fleet' : __('Vehicles'), 'active' => request()->routeIs('vehicles.*') || request()->routeIs('admin.vehicles.*')],
                    ['route' => 'services', 'label' => $isAdmin ? 'Reviews' : __('Services'), 'active' => request()->routeIs('services')],
                    ];
                    @endphp

                    @foreach($links as $link)
                    <a href="{{ route($link['route']) }}"
                        class="relative px-4 py-2 text-xs font-black uppercase tracking-[0.3em] transition-all duration-500 group focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-[#050505] rounded
                               {{ $link['active'] ? 'text-yellow-600 dark:text-yellow-500' : 'text-gray-400 hover:text-gray-900 dark:hover:text-white' }}"
                        aria-current="{{ $link['active'] ? 'page' : 'false' }}">
                        {{ $link['label'] }}
                        <span class="absolute bottom-0 left-4 right-4 h-[1px] bg-yellow-500 origin-left scale-x-0 transition-transform duration-500 group-hover:scale-x-100 {{ $link['active'] ? 'scale-x-100' : '' }}" aria-hidden="true"></span>
                    </a>
                    @endforeach
                    <a href="http://localhost:8001/hotels"
                        class="relative px-4 py-2 text-xs font-black uppercase tracking-[0.3em] transition-all duration-500 group text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        {{ __('Hotels') }}
                        <span class="absolute bottom-0 left-4 right-4 h-[1px] bg-yellow-500 origin-left scale-x-0 transition-transform duration-500 group-hover:scale-x-100"></span>
                    </a>
                </div>
            </div>

            <!-- Right Side: All Action Buttons in one line -->
            <div class="hidden lg:flex items-center gap-6">

                {{-- Language Switcher --}}
                <div class="relative group">
                    <button class="flex items-center gap-1 text-[10px] font-black uppercase tracking-widest text-gray-900 dark:text-white hover:text-yellow-600 transition-colors">
                        @if(App::getLocale() == 'vi')
                        <span class="fi fi-vn"></span> VI
                        @else
                        <span class="fi fi-us"></span> EN
                        @endif
                        <i class="fa-solid fa-chevron-down text-[8px]"></i>
                    </button>
                    <div class="absolute right-0 top-full mt-2 w-24 bg-white dark:bg-[#0a0a0a] border border-gray-100 dark:border-white/5 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-50">
                        <a href="{{ route('lang.switch', 'vi') }}" class="block px-4 py-2 text-[10px] font-bold text-gray-600 dark:text-gray-300 hover:text-yellow-500 hover:bg-gray-50 dark:hover:bg-white/5 first:rounded-t-lg">
                            TIẾNG VIỆT
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-[10px] font-bold text-gray-600 dark:text-gray-300 hover:text-yellow-500 hover:bg-gray-50 dark:hover:bg-white/5 last:rounded-b-lg">
                            ENGLISH
                        </a>
                    </div>
                </div>

                {{-- Notification Bell (Authenticated Users Only) --}}
                @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="relative text-gray-600 dark:text-gray-300 hover:text-yellow-600 dark:hover:text-yellow-500 transition-colors">
                        <i class="fa-solid fa-bell text-lg"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">
                            {{ auth()->user()->unreadNotifications->count() > 9 ? '9+' : auth()->user()->unreadNotifications->count() }}
                        </span>
                        @endif
                    </button>

                    {{-- Dropdown --}}
                    <div x-show="open"
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="absolute right-0 top-full mt-3 w-80 bg-white dark:bg-[#0a0a0a] border border-gray-100 dark:border-white/10 rounded-2xl shadow-2xl z-50"
                        style="display: none;">

                        {{-- Header --}}
                        <div class="px-4 py-3 border-b border-gray-100 dark:border-white/10 flex items-center justify-between">
                            <h3 class="text-xs font-black uppercase tracking-wider text-gray-900 dark:text-white">Thông báo</h3>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                            <form action="{{ route('notifications.read-all') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs font-bold text-blue-600 hover:text-blue-700">Đánh dấu tất cả</button>
                            </form>
                            @endif
                        </div>

                        {{-- Notifications List --}}
                        <div class="max-h-96 overflow-y-auto">
                            @forelse(auth()->user()->notifications->take(5) as $notification)
                            <div class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors border-b border-gray-50 dark:border-white/5 {{ $notification->read_at ? 'opacity-60' : '' }}">
                                <div class="flex gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-500/10 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-bell text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-gray-900 dark:text-white mb-1">
                                            {{ $notification->data['message'] ?? 'Thông báo mới' }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    @if(!$notification->read_at)
                                    <span class="w-2 h-2 bg-blue-500 rounded-full block flex-shrink-0 mt-2"></span>
                                    @endif
                                </div>
                            </div>
                            @empty
                            <div class="px-4 py-8 text-center">
                                <i class="fa-solid fa-inbox text-4xl text-gray-300 dark:text-gray-700 mb-2"></i>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Chưa có thông báo</p>
                            </div>
                            @endforelse
                        </div>

                        {{-- Footer --}}
                        @if(auth()->user()->notifications->count() > 0)
                        <div class="px-4 py-3 border-t border-gray-100 dark:border-white/10">
                            <a href="{{ route('notifications.index') }}" class="block text-center text-xs font-bold text-blue-600 hover:text-blue-700">
                                Xem tất cả thông báo
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endauth

                {{-- New Animated Dark Mode Toggle --}}
                <label class="theme-switch" for="theme-toggle">
                    <input type="checkbox" id="theme-toggle" class="theme-switch__checkbox" :checked="darkMode" @change="toggleDark()" />
                    <div class="theme-switch__container">
                        <div class="theme-switch__clouds"></div>
                        <div class="theme-switch__stars-container">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 55" fill="none">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M135.831 3.00688C135.055 3.85027 134.111 4.29946 133 4.35447C134.111 4.40947 135.055 4.85867 135.831 5.71123C136.607 6.55462 136.996 7.56303 136.996 8.72727C136.996 7.95722 137.172 7.25134 137.525 6.59129C137.886 5.93124 138.372 5.39954 138.98 5.00535C139.598 4.60199 140.268 4.39114 141 4.35447C139.88 4.2903 138.936 3.85027 138.16 3.00688C137.384 2.16348 136.996 1.16425 136.996 0C136.996 1.16425 136.607 2.16348 135.831 3.00688ZM31 23.3545C32.1114 23.2995 33.0551 22.8503 33.8313 22.0069C34.6075 21.1635 34.9956 20.1642 34.9956 19C34.9956 20.1642 35.3837 21.1635 36.1599 22.0069C36.9361 22.8503 37.8798 23.2903 39 23.3545C38.2679 23.3911 37.5976 23.602 36.9802 24.0053C36.3716 24.3995 35.8864 24.9312 35.5248 25.5913C35.172 26.2513 34.9956 26.9572 34.9956 27.7273C34.9956 26.563 34.6075 25.5546 33.8313 24.7112C33.0551 23.8587 32.1114 23.4095 31 23.3545ZM0 36.3545C1.11136 36.2995 2.05513 35.8503 2.83131 35.0069C3.6075 34.1635 3.99559 33.1642 3.99559 32C3.99559 33.1642 4.38368 34.1635 5.15987 35.0069C5.93605 35.8503 6.87982 36.2903 8 36.3545C7.26792 36.3911 6.59757 36.602 5.98015 37.0053C5.37155 37.3995 4.88644 37.9312 4.52481 38.5913C4.172 39.2513 3.99559 39.9572 3.99559 40.7273C3.99559 39.563 3.6075 38.5546 2.83131 37.7112C2.05513 36.8587 1.11136 36.4095 0 36.3545ZM56.8313 24.0069C56.0551 24.8503 55.1114 25.2995 54 25.3545C55.1114 25.4095 56.0551 25.8587 56.8313 26.7112C57.6075 27.5546 57.9956 28.563 57.9956 29.7273C57.9956 28.9572 58.172 28.2513 58.5248 27.5913C58.8864 26.9312 59.3716 26.3995 59.9802 26.0053C60.5976 25.602 61.2679 25.3911 62 25.3545C60.8798 25.2903 59.9361 24.8503 59.1599 24.0069C58.3837 23.1635 57.9956 22.1642 57.9956 21C57.9956 22.1642 57.6075 23.1635 56.8313 24.0069ZM81 25.3545C82.1114 25.2995 83.0551 24.8503 83.8313 24.0069C84.6075 23.1635 84.9956 22.1642 84.9956 21C84.9956 22.1642 85.3837 23.1635 86.1599 24.0069C86.9361 24.8503 87.8798 25.2903 89 25.3545C88.2679 25.3911 87.5976 25.602 86.9802 26.0053C86.3716 26.3995 85.8864 26.9312 85.5248 27.5913C85.172 28.2513 84.9956 28.9572 84.9956 29.7273C84.9956 28.563 84.6075 27.5546 83.8313 26.7112C83.0551 25.8587 82.1114 25.4095 81 25.3545ZM136 36.3545C137.111 36.2995 138.055 35.8503 138.831 35.0069C139.607 34.1635 139.996 33.1642 139.996 32C139.996 33.1642 140.384 34.1635 141.16 35.0069C141.936 35.8503 142.88 36.2903 144 36.3545C143.268 36.3911 142.598 36.602 141.98 37.0053C141.372 37.3995 140.886 37.9312 140.525 38.5913C140.172 39.2513 139.996 39.9572 139.996 40.7273C139.996 39.563 139.607 38.5546 138.831 37.7112C138.055 36.8587 137.111 36.4095 136 36.3545ZM101.831 49.0069C101.055 49.8503 100.111 50.2995 99 50.3545C100.111 50.4095 101.055 50.8587 101.831 51.7112C102.607 52.5546 102.996 53.563 102.996 54.7273C102.996 53.9572 103.172 53.2513 103.525 52.5913C103.886 51.9312 104.372 51.3995 104.98 51.0053C105.598 50.602 106.268 50.3911 107 50.3545C105.88 50.2903 104.936 49.8503 104.16 49.0069C103.384 48.1635 102.996 47.1642 102.996 46C102.996 47.1642 102.607 48.1635 101.831 49.0069Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                        <div class="theme-switch__circle-container">
                            <div class="theme-switch__sun-moon-container">
                                <div class="theme-switch__moon">
                                    <div class="theme-switch__spot"></div>
                                    <div class="theme-switch__spot"></div>
                                    <div class="theme-switch__spot"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </label>

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
                            <x-dropdown-link :href="route('profile.edit')" class="text-[10px] font-black uppercase tracking-widest py-3">{{ __('Dashboard') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('bookings.history')" class="text-[10px] font-black uppercase tracking-widest py-3">{{ __('History') ?? 'Lịch sử' }}</x-dropdown-link>
                            @if($isAdmin)
                            <div class="border-t border-gray-100 dark:border-white/5 mx-4 my-1"></div>
                            <x-dropdown-link :href="route('admin.dashboard')" class="text-[10px] font-black uppercase tracking-widest py-3 text-amber-500">Admin</x-dropdown-link>
                            @endif
                            <div class="border-t border-gray-100 dark:border-white/5 mx-4 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-[10px] font-black uppercase tracking-widest py-3 text-red-500" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Logout') }}</x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
                @else
                <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-900 dark:text-white border-b border-yellow-500/50 pb-0.5 hover:border-yellow-500 transition-all">{{ __('Login') }}</a>
                @endauth
            </div>

            <!-- Mobile Hamburger Button - Phase 4 Enhanced -->
            <div class="flex items-center gap-4 lg:hidden">
                {{-- Dark Mode Toggle Mobile --}}
                <label class="theme-switch" for="theme-toggle-mobile">
                    <input type="checkbox" id="theme-toggle-mobile" class="theme-switch__checkbox" :checked="darkMode" @change="toggleDark()" />
                    <div class="theme-switch__container">
                        <div class="theme-switch__clouds"></div>
                        <div class="theme-switch__circle-container">
                            <div class="theme-switch__sun-moon-container">
                                <div class="theme-switch__moon">
                                    <div class="theme-switch__spot"></div>
                                    <div class="theme-switch__spot"></div>
                                    <div class="theme-switch__spot"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </label>

                <button
                    @click="open = ! open"
                    class="min-w-[44px] min-h-[44px] flex items-center justify-center text-gray-900 dark:text-white hover:text-yellow-600 transition-all focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 rounded-lg"
                    aria-label="Toggle navigation menu"
                    aria-expanded="false"
                    :aria-expanded="open.toString()">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


    {{-- Phase 4: Enhanced Mobile Menu with Accessibility --}}
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        @keydown.escape.window="open = false"
        role="dialog"
        aria-modal="true"
        aria-label="Mobile navigation menu"
        class="lg:hidden bg-white dark:bg-[#0a0a0a] border-t border-gray-100 dark:border-white/5 shadow-2xl">

        <div class="px-6 py-8 space-y-2">
            @foreach($links as $link)
            <a href="{{ route($link['route']) }}"
                class="block min-h-[44px] px-4 py-3 text-sm font-black uppercase tracking-wider text-gray-900 dark:text-gray-100 hover:bg-yellow-50 dark:hover:bg-yellow-900/10 hover:text-yellow-600 rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2"
                aria-current="{{ $link['active'] ? 'page' : 'false' }}">
                {{ $link['label'] }}
            </a>
            @endforeach

            <a href="http://localhost:8001/hotels"
                class="block min-h-[44px] px-4 py-3 text-sm font-black uppercase tracking-wider text-gray-900 dark:text-gray-100 hover:bg-yellow-50 dark:hover:bg-yellow-900/10 hover:text-yellow-600 rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                {{ __('Hotels') }}
            </a>

            @auth
            <div class="border-t border-gray-200 dark:border-white/10 my-4 pt-4">
                <a href="{{ route('profile.edit') }}"
                    class="block min-h-[44px] px-4 py-3 text-sm font-black uppercase tracking-wider text-gray-900 dark:text-gray-100 hover:bg-yellow-50 dark:hover:bg-yellow-900/10 hover:text-yellow-600 rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('bookings.history') }}"
                    class="block min-h-[44px] px-4 py-3 text-sm font-black uppercase tracking-wider text-gray-900 dark:text-gray-100 hover:bg-yellow-50 dark:hover:bg-yellow-900/10 hover:text-yellow-600 rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                    {{ __('History') ?? 'Lịch sử' }}
                </a>
                @if($isAdmin)
                <a href="{{ route('admin.dashboard') }}"
                    class="block min-h-[44px] px-4 py-3 text-sm font-black uppercase tracking-wider text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/10 rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                    Admin
                </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit"
                        class="w-full min-h-[44px] px-4 py-3 text-sm font-black uppercase tracking-wider text-left text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
            @else
            <div class="border-t border-gray-200 dark:border-white/10 my-4 pt-4">
                <a href="{{ route('login') }}"
                    class="block min-h-[44px] px-4 py-3 text-sm font-black uppercase tracking-wider text-center bg-yellow-500 text-black hover:bg-yellow-600 rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                    {{ __('Login') }}
                </a>
            </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nav = document.getElementById('main-nav');

        // Sticky header logic: Always visible (removed hide-on-scroll)
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 20) {
                nav.classList.add('shadow-xl', 'dark:bg-[#050505]/95');
            } else {
                nav.classList.remove('shadow-xl', 'dark:bg-[#050505]/95');
            }
        }, {
            passive: true
        });
    });
</script>

<style>
    [x-cloak] {
        display: none !important;
    }

    #main-nav {
        will-change: transform, background-color;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), background 0.3s ease;
    }
</style>