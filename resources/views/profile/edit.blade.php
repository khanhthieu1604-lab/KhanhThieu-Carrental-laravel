@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-[#0a0a0a] min-h-screen py-12 transition-colors duration-500 font-sans text-sm relative overflow-hidden">
    
    
    <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-blue-900/10 to-transparent dark:from-yellow-500/5 pointer-events-none"></div>

    <div class="container mx-auto px-4 max-w-6xl relative z-10">

        
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4 animate-fade-in-down">
            <div>
                <h1 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight">Hồ sơ cá nhân</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 font-medium">Quản lý thông tin tài khoản và bảo mật của bạn.</p>
            </div>
            
            @if(session('status'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                     class="px-4 py-2 bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 rounded-lg flex items-center gap-2 shadow-sm backdrop-blur-sm animate-bounce-in">
                    <i class="fa-solid fa-circle-check"></i>
                    <span class="font-bold text-xs uppercase">
                        @if(session('status') === 'profile-updated') Đã cập nhật hồ sơ
                        @elseif(session('status') === 'password-updated') Đã đổi mật khẩu
                        @else {{ session('status') }}
                        @endif
                    </span>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            
            <div class="lg:col-span-4 space-y-6">
                
                
                <div class="bg-white/80 dark:bg-[#121212]/80 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-white/5 p-8 text-center sticky top-24 transition-all hover:shadow-2xl group animate-fade-in-up">
                    
                    <div class="relative w-32 h-32 mx-auto mb-6">
                        <div class="w-full h-full rounded-full p-1 bg-gradient-to-tr from-blue-600 to-cyan-400 dark:from-yellow-400 dark:to-yellow-600 group-hover:rotate-180 transition-all duration-700">
                            <div class="w-full h-full rounded-full bg-white dark:bg-[#121212] p-1 group-hover:rotate-180 transition-all duration-700">
                                <div class="w-full h-full rounded-full overflow-hidden bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-4xl font-black text-gray-400 dark:text-gray-500 uppercase">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($user->name, 0, 1) }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="absolute bottom-1 right-1 bg-green-500 w-5 h-5 rounded-full border-4 border-white dark:border-[#121212]" title="Online"></div>
                    </div>

                    <h2 class="text-xl font-black text-gray-900 dark:text-white mb-1">{{ $user->name }}</h2>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $user->email }}</p>

                    <div class="mt-6 flex justify-center">
                        @if($user->phone && $user->address)
                            <span class="px-4 py-1.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-[10px] font-bold uppercase tracking-wider border border-green-200 dark:border-green-800 flex items-center gap-2">
                                <i class="fa-solid fa-shield-halved"></i> Tài khoản đã xác thực
                            </span>
                        @else
                            <span class="px-4 py-1.5 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 rounded-full text-[10px] font-bold uppercase tracking-wider border border-yellow-200 dark:border-yellow-800 animate-pulse flex items-center gap-2">
                                <i class="fa-solid fa-triangle-exclamation"></i> Chưa hoàn thiện hồ sơ
                            </span>
                        @endif
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-100 dark:border-white/5 grid grid-cols-2 gap-4 text-left">
                        <div>
                            <span class="block text-[10px] uppercase text-gray-400 font-bold mb-1">Thành viên từ</span>
                            <span class="font-bold text-gray-800 dark:text-gray-200">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase text-gray-400 font-bold mb-1">Cấp độ</span>
                            <span class="font-bold text-blue-600 dark:text-yellow-500"><i class="fa-solid fa-crown mr-1"></i> Member</span>
                        </div>
                    </div>
                </div>

            </div>

            
            <div class="lg:col-span-8 space-y-8">

                
                <div class="bg-white dark:bg-[#121212] rounded-2xl shadow-sm border border-gray-200 dark:border-white/5 overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
                    <div class="p-6 border-b border-gray-100 dark:border-white/5 flex items-center justify-between">
                        <h3 class="font-bold text-lg text-gray-900 dark:text-white flex items-center gap-2">
                            <i class="fa-regular fa-id-card text-blue-600 dark:text-yellow-500"></i> Thông tin cá nhân
                        </h3>
                    </div>
                    
                    <div class="p-8">
                        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('patch')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Họ và tên</label>
                                    <div class="relative group">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-blue-600 dark:group-focus-within:text-yellow-500 transition-colors">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                            class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-blue-500 dark:focus:ring-yellow-500 focus:border-transparent dark:text-white transition-all shadow-sm">
                                    </div>
                                    @error('name') <span class="text-red-500 text-xs ml-1 font-bold">{{ $message }}</span> @enderror
                                </div>

                                
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Email</label>
                                    <div class="relative group">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-blue-600 dark:group-focus-within:text-yellow-500 transition-colors">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                            class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-blue-500 dark:focus:ring-yellow-500 focus:border-transparent dark:text-white transition-all shadow-sm">
                                    </div>
                                    @error('email') <span class="text-red-500 text-xs ml-1 font-bold">{{ $message }}</span> @enderror
                                </div>

                                
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Số điện thoại <span class="text-red-500">*</span></label>
                                    <div class="relative group">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-blue-600 dark:group-focus-within:text-yellow-500 transition-colors">
                                            <i class="fa-solid fa-phone"></i>
                                        </span>
                                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Nhập số điện thoại..."
                                            class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-blue-500 dark:focus:ring-yellow-500 focus:border-transparent dark:text-white transition-all shadow-sm">
                                    </div>
                                    @error('phone') <span class="text-red-500 text-xs ml-1 font-bold">{{ $message }}</span> @enderror
                                </div>

                                
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Địa chỉ <span class="text-red-500">*</span></label>
                                    <div class="relative group">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-blue-600 dark:group-focus-within:text-yellow-500 transition-colors">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>
                                        <input type="text" name="address" value="{{ old('address', $user->address) }}" placeholder="Nhập địa chỉ..."
                                            class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-blue-500 dark:focus:ring-yellow-500 focus:border-transparent dark:text-white transition-all shadow-sm">
                                    </div>
                                    @error('address') <span class="text-red-500 text-xs ml-1 font-bold">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit" class="relative group px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-black rounded-xl font-black text-xs uppercase tracking-widest overflow-hidden shadow-lg hover:shadow-xl transition-all hover:-translate-y-0.5">
                                    <span class="relative z-10 group-hover:text-blue-400 dark:group-hover:text-yellow-600 transition-colors flex items-center gap-2">
                                        <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
                                    </span>
                                    <div class="absolute inset-0 bg-gray-800 dark:bg-gray-100 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                
                <div class="bg-white dark:bg-[#121212] rounded-2xl shadow-sm border border-gray-200 dark:border-white/5 overflow-hidden animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="p-6 border-b border-gray-100 dark:border-white/5">
                        <h3 class="font-bold text-lg text-gray-900 dark:text-white flex items-center gap-2">
                            <i class="fa-solid fa-lock text-blue-600 dark:text-yellow-500"></i> Bảo mật tài khoản
                        </h3>
                    </div>

                    <div class="p-8">
                        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf
                            @method('put')

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Mật khẩu hiện tại</label>
                                <div class="relative group">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-blue-600 dark:group-focus-within:text-yellow-500 transition-colors">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                    <input type="password" name="current_password" required
                                        class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-blue-500 dark:focus:ring-yellow-500 focus:border-transparent dark:text-white transition-all">
                                </div>
                                @error('current_password', 'updatePassword') <span class="text-red-500 text-xs ml-1 font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Mật khẩu mới</label>
                                    <div class="relative group">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-blue-600 dark:group-focus-within:text-yellow-500 transition-colors">
                                            <i class="fa-solid fa-unlock"></i>
                                        </span>
                                        <input type="password" name="password" required
                                            class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-blue-500 dark:focus:ring-yellow-500 focus:border-transparent dark:text-white transition-all">
                                    </div>
                                    @error('password', 'updatePassword') <span class="text-red-500 text-xs ml-1 font-bold">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Nhập lại mật khẩu</label>
                                    <div class="relative group">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-blue-600 dark:group-focus-within:text-yellow-500 transition-colors">
                                            <i class="fa-solid fa-check-double"></i>
                                        </span>
                                        <input type="password" name="password_confirmation" required
                                            class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-blue-500 dark:focus:ring-yellow-500 focus:border-transparent dark:text-white transition-all">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit" class="px-6 py-3 bg-gray-200 dark:bg-zinc-800 text-gray-800 dark:text-gray-200 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-zinc-700 transition-colors shadow-sm">
                                    Cập nhật mật khẩu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                
                <div class="bg-red-50/50 dark:bg-red-900/10 rounded-2xl border border-red-100 dark:border-red-900/30 overflow-hidden animate-fade-in-up" style="animation-delay: 0.3s;">
                    <div class="p-6 flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-lg text-red-600 dark:text-red-500">Xóa tài khoản</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Hành động này không thể hoàn tác. Dữ liệu của bạn sẽ bị xóa vĩnh viễn.</p>
                        </div>
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
                            class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg text-xs uppercase shadow transition-colors">
                            Xóa
                        </button>
                    </div>
                </div>

                
                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white dark:bg-[#18181b]">
                        @csrf
                        @method('delete')
                        
                        <div class="text-center mb-6">
                            <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <h2 class="text-xl font-black text-gray-900 dark:text-white">Bạn có chắc chắn?</h2>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Vui lòng nhập mật khẩu để xác nhận xóa tài khoản.</p>
                        </div>

                        <div class="mt-6">
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                                <input type="password" name="password" placeholder="Mật khẩu của bạn" 
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-red-500 focus:border-transparent dark:text-white">
                            </div>
                            @error('password', 'userDeletion') <span class="text-red-500 text-xs mt-1 font-bold block">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 dark:border-white/5 pt-6">
                            <button type="button" x-on:click="$dispatch('close')" class="px-5 py-2.5 bg-gray-100 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 rounded-lg font-bold text-xs uppercase hover:bg-gray-200 transition">Hủy bỏ</button>
                            <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold text-xs uppercase shadow-lg shadow-red-500/30 transition">Xác nhận xóa</button>
                        </div>
                    </form>
                </x-modal>

            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .animate-fade-in-down { animation: fadeInDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
@endsection