@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-[#050505] min-h-screen py-12 transition-colors duration-500">
    <div class="container mx-auto px-8 max-w-7xl">
        
        
        <div class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-end gap-6 animate-page-entry">
            <div>
                <p class="text-[10px] font-black text-amber-600 dark:text-amber-500 uppercase tracking-[0.4em] mb-3">Service Quality Control</p>
                <h1 class="text-5xl font-black text-zinc-900 dark:text-white tracking-tighter uppercase">
                    Đánh giá <span class="opacity-20 italic">Khách hàng</span>
                </h1>
                <p class="text-zinc-500 mt-4 text-xs uppercase tracking-widest font-medium">Quản lý phản hồi và trải nghiệm dịch vụ của khách hàng VIP.</p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="px-6 py-3 bg-zinc-50 dark:bg-white/5 border border-zinc-200 dark:border-white/5 rounded-full text-[10px] font-black uppercase tracking-widest text-zinc-900 dark:text-zinc-100">
                    Tổng số: {{ $reviews->total() }} Phản hồi
                </div>
            </div>
        </div>

        
        <div class="bg-white dark:bg-[#0a0a0a] rounded-[2.5rem] border border-zinc-100 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50/50 dark:bg-zinc-900/20 text-zinc-400 uppercase text-[9px] font-black tracking-[0.2em]">
                            <th class="px-8 py-6">Khách hàng</th>
                            <th class="px-8 py-6">Sản phẩm / Xe</th>
                            <th class="px-8 py-6">Nội dung đánh giá</th>
                            <th class="px-8 py-6 text-center">Xếp hạng</th>
                            <th class="px-8 py-6 text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-50 dark:divide-white/5 text-[11px]">
                        @forelse($reviews as $review)
                        <tr class="group hover:bg-zinc-50/50 dark:hover:bg-white/[0.02] transition-all duration-300">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-zinc-900 dark:bg-white text-white dark:text-black flex items-center justify-center font-black text-xs uppercase">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-zinc-900 dark:text-zinc-100 uppercase tracking-tighter">{{ $review->user->name }}</div>
                                        <div class="text-[9px] text-zinc-400 uppercase tracking-widest mt-1">{{ $review->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-zinc-900 dark:text-zinc-300 font-bold uppercase tracking-widest">{{ $review->vehicle->name ?? 'N/A' }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-zinc-500 dark:text-zinc-400 leading-relaxed italic max-w-xs">"{{ $review->comment }}"</p>
                            </td>
                            <td class="px-8 py-6 text-center text-amber-500">
                                <div class="flex justify-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star text-[10px]"></i>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <div class="flex justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all">
                                    
                                    <form action="#" method="POST" onsubmit="return confirm('Xóa đánh giá này?')">
                                        @csrf @method('DELETE')
                                        <button class="text-rose-500 hover:text-rose-700 transition-colors uppercase font-black text-[9px] tracking-widest">Gỡ bỏ</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-32 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fa-regular fa-comment-dots text-4xl text-zinc-200 dark:text-zinc-800 mb-4"></i>
                                    <p class="text-zinc-400 uppercase tracking-[0.3em] text-[10px]">Chưa có phản hồi nào từ khách hàng.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            
            <div class="p-8 border-t border-zinc-50 dark:border-white/5">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes pageEntry {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-page-entry {
        animation: pageEntry 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>
@endsection