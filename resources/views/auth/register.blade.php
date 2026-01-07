@extends('layouts.app')

@section('content')

<div class="min-h-[calc(100vh-80px)] flex items-center justify-center relative bg-gray-100 dark:bg-[#050505] py-10 px-4 transition-colors duration-500">
    
    
    <div class="absolute inset-0 z-0 overflow-hidden">
        
        <img src="https://images.unsplash.com/photo-1562426509-5044a121aa49?q=80&w=2070&auto=format&fit=crop" 
             class="w-full h-full object-cover opacity-10 dark:opacity-20 transition-opacity duration-500 scale-105 animate-slow-zoom">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-100 via-transparent to-gray-100 dark:from-[#050505] dark:via-transparent dark:to-[#050505]"></div>
    </div>

    
    <div class="relative z-10 w-full max-w-md bg-white/80 dark:bg-[#121212]/80 backdrop-blur-xl rounded-3xl shadow-2xl dark:shadow-[0_0_40px_rgba(0,0,0,0.5)] overflow-hidden border border-white/20 dark:border-white/10 animate-fade-in-up transition-all duration-300">
        
        
        <div class="h-1 w-full bg-gradient-to-r from-yellow-600 via-yellow-400 to-yellow-600"></div>

        <div class="p-8 pb-0 text-center">
            <div class="flex justify-center mb-6">
                
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center shadow-lg transform rotate-6 hover:rotate-0 transition-transform duration-300">
                    <i class="fa-solid fa-user-plus text-3xl text-black"></i>
                </div>
            </div>
            <h2 class="text-3xl font-black text-gray-900 dark:text-white font-heading uppercase tracking-tighter">Đăng Ký</h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-2 font-medium">Trở thành thành viên <span class="text-yellow-600 dark:text-yellow-500 font-bold">VIP</span> ngay hôm nay</p>
        </div>

        <div class="p-8 pt-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                
                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-wider ml-1">Họ tên</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-yellow-500 transition-colors duration-300">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-medium text-gray-900 dark:text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-all placeholder-gray-400 dark:placeholder-gray-600 shadow-sm"
                            placeholder="Nguyễn Văn A">
                    </div>
                    @error('name') <p class="text-red-500 text-xs font-bold mt-1 ml-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
                </div>

                
                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-wider ml-1">Email</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-yellow-500 transition-colors duration-300">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-medium text-gray-900 dark:text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-all placeholder-gray-400 dark:placeholder-gray-600 shadow-sm"
                            placeholder="email@example.com">
                    </div>
                    @error('email') <p class="text-red-500 text-xs font-bold mt-1 ml-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
                </div>

                
                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-wider ml-1">Mật khẩu</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-yellow-500 transition-colors duration-300">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" required
                            class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-medium text-gray-900 dark:text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-all placeholder-gray-400 dark:placeholder-gray-600 shadow-sm"
                            placeholder="********">
                    </div>
                    @error('password') <p class="text-red-500 text-xs font-bold mt-1 ml-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
                </div>

                
                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-wider ml-1">Xác nhận mật khẩu</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-yellow-500 transition-colors duration-300">
                            <i class="fa-solid fa-check-double"></i>
                        </span>
                        <input type="password" name="password_confirmation" required
                            class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-medium text-gray-900 dark:text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-all placeholder-gray-400 dark:placeholder-gray-600 shadow-sm"
                            placeholder="Nhập lại mật khẩu">
                    </div>
                </div>

                
                <button type="submit" class="w-full relative group overflow-hidden bg-gray-900 dark:bg-white text-white dark:text-black font-black py-4 rounded-xl shadow-lg hover:shadow-2xl transform active:scale-[0.98] transition-all duration-300 uppercase text-xs tracking-[0.2em] mt-4">
                    <span class="relative z-10 group-hover:text-yellow-500 dark:group-hover:text-yellow-600 transition-colors">Đăng Ký Ngay</span>
                    <div class="absolute inset-0 bg-gray-800 dark:bg-gray-100 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Đã có tài khoản?
                    <a href="{{ route('login') }}" class="font-bold text-gray-900 dark:text-white hover:text-yellow-600 dark:hover:text-yellow-500 transition-colors ml-1 underline decoration-2 decoration-yellow-500/30 hover:decoration-yellow-500">
                        Đăng nhập ngay
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