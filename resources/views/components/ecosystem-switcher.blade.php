{{-- Ecosystem Switcher Component --}}
{{-- Add this to your navigation bar for cross-app navigation --}}

<div class="relative" x-data="{ open: false }">
    <button @click="open = !open"
        class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-amber-500 transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
        </svg>
        <span class="hidden sm:inline">Ecosystem</span>
        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div x-show="open"
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-72 rounded-xl shadow-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden z-50">

        <div class="p-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white">
            <h4 class="font-semibold text-sm">Thiuu Ecosystem</h4>
            <p class="text-xs text-amber-100">Chuyển đổi giữa các dịch vụ</p>
        </div>

        <div class="p-2">
            {{-- Current App Indicator --}}
            <div class="flex items-center gap-3 p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg mb-2">
                <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if(config('app.name') === 'Thiuu Rental Elite' || str_contains(config('app.name'), 'CarRental'))
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17a2 2 0 100-4 2 2 0 000 4zm8 0a2 2 0 100-4 2 2 0 000 4zM5 13h14l-3-6H8l-3 6z" />
                        @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        @endif
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900 dark:text-white text-sm">{{ config('app.name') }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Đang sử dụng</p>
                </div>
                <svg class="w-5 h-5 text-green-500 ml-auto" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>

            {{-- Switch to Other App --}}
            @auth
            @if(config('app.name') === 'Thiuu Rental Elite' || str_contains(config('app.name'), 'CarRental'))
            <a href="{{ route('sso.to-hotel') }}"
                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group">
                <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900 dark:text-white text-sm">KThiuu Hotel</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Đặt phòng khách sạn 5 sao</p>
                </div>
                <svg class="w-4 h-4 text-gray-400 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            @else
            <a href="{{ route('sso.to-car-rental') }}"
                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group">
                <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17a2 2 0 100-4 2 2 0 000 4zm8 0a2 2 0 100-4 2 2 0 000 4zM5 13h14l-3-6H8l-3 6z" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900 dark:text-white text-sm">Thiuu CarRental</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Thuê siêu xe cao cấp</p>
                </div>
                <svg class="w-4 h-4 text-gray-400 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            @endif
            @else
            <div class="p-3 text-center text-sm text-gray-500 dark:text-gray-400">
                <a href="{{ route('login') }}" class="text-amber-500 hover:underline">Đăng nhập</a> để chuyển đổi nhanh
            </div>
            @endauth
        </div>

        {{-- Portal Link --}}
        <div class="border-t border-gray-200 dark:border-gray-700 p-2">
            <a href="{{ route('sso.portal') }}"
                class="flex items-center justify-center gap-2 p-2 text-sm text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Xem tất cả dịch vụ
            </a>
        </div>
    </div>
</div>