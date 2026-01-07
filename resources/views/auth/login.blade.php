@extends('layouts.app')

@section('content')

<div class="min-h-[calc(100vh-80px)] flex items-center justify-center relative bg-gray-100 dark:bg-[#050505] py-10 px-4 transition-colors duration-500">
    
    
    <div class="absolute inset-0 z-0 overflow-hidden">
        
        <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?q=80&w=2070&auto=format&fit=crop" 
             class="w-full h-full object-cover opacity-10 dark:opacity-20 transition-opacity duration-500 scale-105 animate-slow-zoom">
        
        
        <div class="absolute inset-0 bg-gradient-to-t from-gray-100 via-transparent to-gray-100 dark:from-[#050505] dark:via-transparent dark:to-[#050505]"></div>
    </div>

    
    <div class="relative z-10 w-full max-w-md bg-white/80 dark:bg-[#121212]/80 backdrop-blur-xl rounded-3xl shadow-2xl dark:shadow-[0_0_40px_rgba(0,0,0,0.5)] overflow-hidden border border-white/20 dark:border-white/10 animate-fade-in-up transition-all duration-300">
        
        
        <div class="h-1 w-full bg-gradient-to-r from-yellow-600 via-yellow-400 to-yellow-600"></div>

        <div class="p-8 pb-0 text-center">
            
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-yellow-500 rounded-2xl flex items-center justify-center shadow-lg transform -rotate-6">
                    <i class="fa-solid fa-crown text-3xl text-black"></i>
                </div>
            </div>

            
            @if (session('success'))
                <div class="mb-6 text-sm font-bold text-green-600 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 p-3 rounded-xl flex items-center justify-center gap-2">
                    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <h2 class="text-3xl font-black text-gray-900 dark:text-white font-heading uppercase tracking-tighter">Đăng Nhập</h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-2 font-medium">Chào mừng bạn quay trở lại với <span class="text-yellow-600 dark:text-yellow-500 font-bold">Thiuu Rental</span></p>
        </div>

        <div class="p-8 pt-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                
                @csrf

                
                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-wider ml-1">Email</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-yellow-500 transition-colors duration-300">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-medium text-gray-900 dark:text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-all placeholder-gray-400 dark:placeholder-gray-600 shadow-sm"
                            placeholder="name@example.com">
                    </div>
                    @error('email') <p class="text-red-500 text-xs font-bold mt-1 ml-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
                </div>

                
                <div class="space-y-2">
                    <div class="flex justify-between items-center ml-1">
                        <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-wider">Mật khẩu</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-yellow-600 dark:text-yellow-500 hover:text-yellow-700 transition-colors">Quên mật khẩu?</a>
                        @endif
                    </div>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-yellow-500 transition-colors duration-300">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input id="password" type="password" name="password" required
                            class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-medium text-gray-900 dark:text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-all placeholder-gray-400 dark:placeholder-gray-600 shadow-sm"
                            placeholder="••••••••">
                    </div>
                    @error('password') <p class="text-red-500 text-xs font-bold mt-1 ml-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
                </div>

                
                <div class="flex items-center ml-1">
                    <div class="relative flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" 
                               class="peer h-4 w-4 cursor-pointer appearance-none rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 checked:bg-yellow-500 checked:border-yellow-500 focus:ring-2 focus:ring-yellow-500/30 transition-all">
                        <i class="fa-solid fa-check absolute left-0.5 top-0.5 text-[10px] text-black opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity"></i>
                    </div>
                    <label for="remember_me" class="ml-2 block text-sm font-medium text-gray-600 dark:text-gray-400 cursor-pointer select-none group-hover:text-gray-900 dark:group-hover:text-gray-300">
                        Ghi nhớ đăng nhập
                    </label>
                </div>

                
                <button type="submit" class="w-full relative group overflow-hidden bg-gray-900 dark:bg-white text-white dark:text-black font-black py-4 rounded-xl shadow-lg hover:shadow-2xl transform active:scale-[0.98] transition-all duration-300 uppercase text-xs tracking-[0.2em]">
                    <span class="relative z-10 group-hover:text-yellow-500 dark:group-hover:text-yellow-600 transition-colors">Đăng Nhập</span>
                    <div class="absolute inset-0 bg-gray-800 dark:bg-gray-100 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Chưa là thành viên?
                    <a href="{{ route('register') }}" class="font-bold text-gray-900 dark:text-white hover:text-yellow-600 dark:hover:text-yellow-500 transition-colors ml-1 underline decoration-2 decoration-yellow-500/30 hover:decoration-yellow-500">
                        Đăng ký tài khoản mới
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slowZoom {
        from { transform: scale(1); }
        to { transform: scale(1.1); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .animate-slow-zoom {
        animation: slowZoom 20s linear infinite alternate;
    }
</style>
@endsection