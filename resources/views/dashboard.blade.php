<x-app-layout>
    <div class="min-h-[calc(100vh-65px)] flex items-center justify-center relative bg-white dark:bg-[#050505] py-20 px-6 overflow-hidden transition-colors duration-500">
        
        
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-yellow-500/5 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-zinc-500/5 rounded-full blur-[100px] pointer-events-none"></div>
        </div>

        <div class="relative z-10 w-full max-w-5xl">
            <div class="dashboard-reveal opacity-0">
                
                <div class="text-center mb-16">
                    <span class="inline-block py-2 px-6 rounded-full border border-yellow-500/30 bg-yellow-500/5 text-yellow-600 dark:text-yellow-500 text-[10px] font-black uppercase tracking-[0.5em] mb-8 backdrop-blur-md">
                        Private Access
                    </span>
                    <h1 class="text-5xl md:text-8xl font-black text-zinc-900 dark:text-white mb-6 leading-none tracking-tighter uppercase">
                        Xin chào, <br>
                        <span class="opacity-30">{{ Auth::user()->name }}</span>
                    </h1>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <a href="{{ route('vehicles.index') }}" class="group relative p-1 rounded-[2rem] bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-white/5 transition-all duration-500 hover:border-yellow-500/50">
                        <div class="bg-white dark:bg-[#0a0a0a] rounded-[1.9rem] p-10 h-full relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-500/5 rounded-full blur-2xl group-hover:bg-yellow-500/10 transition-all"></div>
                            
                            <div class="text-3xl text-zinc-400 dark:text-zinc-600 mb-8 group-hover:text-yellow-500 transition-colors duration-500">
                                <i class="fa-solid fa-car-side"></i>
                            </div>
                            <h3 class="text-xl font-black text-zinc-900 dark:text-white uppercase tracking-widest mb-4">Danh sách xe</h3>
                            <p class="text-zinc-500 dark:text-zinc-400 text-xs uppercase tracking-wider leading-relaxed">
                                Khám phá bộ sưu tập kiệt tác cơ khí dành riêng cho hành trình của bạn.
                            </p>
                            <div class="mt-8 flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-yellow-600 dark:text-yellow-500">
                                ENTER COLLECTION <span class="w-8 h-px bg-yellow-500 group-hover:w-16 transition-all duration-500"></span>
                            </div>
                        </div>
                    </a>

                    
                    <a href="{{ route('profile.edit') }}" class="group relative p-1 rounded-[2rem] bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-white/5 transition-all duration-500 hover:border-zinc-400 dark:hover:border-zinc-500">
                        <div class="bg-white dark:bg-[#0a0a0a] rounded-[1.9rem] p-10 h-full relative overflow-hidden">
                            <div class="text-3xl text-zinc-400 dark:text-zinc-600 mb-8 group-hover:text-zinc-900 dark:group-hover:text-white transition-colors duration-500">
                                <i class="fa-solid fa-sliders"></i>
                            </div>
                            <h3 class="text-xl font-black text-zinc-900 dark:text-white uppercase tracking-widest mb-4">Thiết lập hồ sơ</h3>
                            <p class="text-zinc-500 dark:text-zinc-400 text-xs uppercase tracking-wider leading-relaxed">
                                Cập nhật thông tin cá nhân và quản lý bảo mật tài khoản thành viên.
                            </p>
                            <div class="mt-8 flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-zinc-400 dark:text-zinc-500 group-hover:text-zinc-900 dark:group-hover:text-white">
                                EDIT ACCOUNT <span class="w-8 h-px bg-zinc-300 dark:bg-zinc-700 group-hover:bg-zinc-900 dark:group-hover:bg-zinc-100 transition-all duration-500"></span>
                            </div>
                        </div>
                    </a>
                </div>

                
                <div class="mt-16 text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-[10px] font-black uppercase tracking-[0.4em] text-zinc-400 hover:text-red-500 transition-colors duration-300">
                            — Đăng xuất hệ thống —
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            anime({
                targets: '.dashboard-reveal',
                opacity: [0, 1],
                translateY: [40, 0],
                easing: 'easeOutQuart',
                duration: 1500,
                delay: 300
            });
        });
    </script>
</x-app-layout>