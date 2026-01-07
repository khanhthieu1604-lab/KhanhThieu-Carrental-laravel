@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-[#0a0a0a] min-h-screen py-10 font-sans transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8 animate-fade-in-down">
            <div>
                <h2 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight">Quản lý Thành viên</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">Danh sách tất cả người dùng trong hệ thống Thiuu Rental.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="bg-white dark:bg-[#121212] px-5 py-2.5 rounded-xl shadow-sm border border-gray-200 dark:border-white/10 flex items-center gap-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tổng thành viên</span>
                    <span class="text-xl font-black text-gray-900 dark:text-white">{{ $users->total() }}</span>
                </div>
            </div>
        </div>

        
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                 class="bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 px-4 py-3 rounded-xl mb-6 text-sm font-bold flex items-center gap-2 shadow-sm backdrop-blur-sm animate-bounce-in">
                <i class="fa-solid fa-circle-check text-lg"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                 class="bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 px-4 py-3 rounded-xl mb-6 text-sm font-bold flex items-center gap-2 shadow-sm backdrop-blur-sm animate-bounce-in">
                <i class="fa-solid fa-circle-exclamation text-lg"></i> {{ session('error') }}
            </div>
        @endif

        
        <div class="bg-white dark:bg-[#121212] shadow-xl shadow-gray-200/50 dark:shadow-none rounded-3xl overflow-hidden border border-gray-100 dark:border-white/5 animate-fade-in-up">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-100 dark:border-white/5 text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold">
                            <th class="px-6 py-5 pl-8">Thành viên</th>
                            <th class="px-6 py-5">Vai trò</th>
                            <th class="px-6 py-5">Bảo mật</th>
                            <th class="px-6 py-5">Ngày tham gia</th>
                            <th class="px-6 py-5 text-center pr-8">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @foreach($users as $user)
                        <tr class="group hover:bg-gray-50 dark:hover:bg-white/[0.02] transition-colors duration-200">
                            
                            <td class="px-6 py-4 pl-8">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-500 to-cyan-400 flex items-center justify-center text-white font-black text-sm uppercase shadow-lg shadow-blue-500/30">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        @if($user->role === 'admin')
                                            <div class="absolute -bottom-1 -right-1 bg-yellow-400 text-white text-[8px] w-4 h-4 flex items-center justify-center rounded-full border-2 border-white dark:border-[#121212]" title="Admin">
                                                <i class="fa-solid fa-crown"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 dark:text-white text-sm group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            
                            <td class="px-6 py-4">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wide bg-gradient-to-r from-red-500 to-pink-500 text-white shadow-md shadow-red-500/20">
                                        <i class="fa-solid fa-user-shield"></i> Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wide bg-gray-100 dark:bg-white/10 text-gray-600 dark:text-gray-300">
                                        <i class="fa-solid fa-user"></i> Member
                                    </span>
                                @endif
                            </td>

                            
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-white/5 px-3 py-1.5 rounded-lg w-fit border border-gray-100 dark:border-white/5">
                                    <i class="fa-solid fa-fingerprint text-green-500"></i>
                                    <span class="font-mono">••••••••</span>
                                </div>
                            </td>

                            
                            <td class="px-6 py-4">
                                <span class="text-xs font-semibold text-gray-600 dark:text-gray-300">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </span>
                                <div class="text-[10px] text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
                            </td>

                            
                            <td class="px-6 py-4 pr-8">
                                <div class="flex items-center justify-center gap-3 opacity-60 group-hover:opacity-100 transition-opacity">
                                    
                                    <form action="{{ route('admin.users.role', $user->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button class="w-8 h-8 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-500 transition-all flex items-center justify-center shadow-sm" title="Đổi quyền hạn">
                                            <i class="fa-solid fa-arrows-rotate text-xs"></i>
                                        </button>
                                    </form>

                                    
                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('CẢNH BÁO: Hành động này không thể hoàn tác!\nBạn chắc chắn muốn xóa tài khoản {{ $user->name }}?')">
                                            @csrf @method('DELETE')
                                            <button class="w-8 h-8 rounded-full bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-600 hover:text-white dark:hover:bg-red-500 transition-all flex items-center justify-center shadow-sm" title="Xóa tài khoản">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-zinc-800 text-gray-300 flex items-center justify-center cursor-not-allowed" title="Không thể xóa chính mình">
                                            <i class="fa-solid fa-ban text-xs"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            
            <div class="px-6 py-4 border-t border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-white/5">
                {{ $users->links() }}
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
    @keyframes bounceIn {
        0% { transform: scale(0.9); opacity: 0; }
        50% { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(1); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-fade-in-down { animation: fadeInDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-bounce-in { animation: bounceIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
</style>
@endsection