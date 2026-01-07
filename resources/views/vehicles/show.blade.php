@extends('layouts.app')

@section('content')

<div class="bg-gray-50 dark:bg-[#050505] min-h-screen py-10 transition-colors duration-500 font-sans relative overflow-x-hidden">
    
    
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500/5 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-yellow-500/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="container mx-auto px-4 max-w-7xl relative z-10">
        
        
        <nav class="flex items-center gap-2 mb-8 text-xs font-bold uppercase tracking-wider text-gray-400 animate-fade-in-up">
            <a href="{{ route('home') }}" class="hover:text-yellow-500 transition-colors"><i class="fa-solid fa-house"></i></a>
            <span class="text-gray-300 dark:text-gray-700">/</span>
            <a href="{{ route('vehicles.index') }}" class="hover:text-yellow-500 transition-colors">Danh sách xe</a>
            <span class="text-gray-300 dark:text-gray-700">/</span>
            <span class="text-gray-900 dark:text-white">{{ $vehicle->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            
            
            <div class="lg:col-span-8 space-y-10 animate-fade-in-up" style="animation-delay: 0.1s;">
                
                
                <div class="group relative bg-gray-200 dark:bg-[#121212] rounded-[2.5rem] overflow-hidden shadow-2xl dark:shadow-none border border-white/50 dark:border-white/5">
                    
                    <div class="aspect-w-16 aspect-h-10 overflow-hidden">
                        <img src="{{ str_starts_with($vehicle->image, 'http') ? $vehicle->image : asset('storage/' . $vehicle->image) }}" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition duration-[2s] ease-in-out"
                             onerror="this.src='https://placehold.co/800x500/222/white?text=Luxury+Car'">
                    </div>

                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>

                    
                    <div class="absolute top-6 right-6">
                        @if($vehicle->status == 'available')
                            <div class="backdrop-blur-md bg-green-500/20 border border-green-500/30 text-green-400 px-4 py-2 rounded-full text-xs font-black uppercase tracking-widest shadow-lg flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Sẵn sàng
                            </div>
                        @else
                            <div class="backdrop-blur-md bg-red-500/20 border border-red-500/30 text-red-400 px-4 py-2 rounded-full text-xs font-black uppercase tracking-widest shadow-lg flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span> Đã được thuê
                            </div>
                        @endif
                    </div>

                    
                    <button class="absolute bottom-6 right-6 bg-white/20 hover:bg-white/40 backdrop-blur-md text-white px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2">
                        <i class="fa-solid fa-expand"></i> Xem chi tiết
                    </button>
                </div>

                
                <div>
                    <h3 class="text-lg font-black text-gray-900 dark:text-white uppercase tracking-wider mb-6 flex items-center gap-2">
                        <span class="w-8 h-1 bg-yellow-500 rounded-full"></span> Thông số xe
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        
                        <div class="p-5 rounded-2xl bg-white dark:bg-[#121212] border border-gray-100 dark:border-white/5 shadow-sm hover:shadow-md hover:border-yellow-500/30 transition-all group">
                            <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-500 mb-3 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-chair"></i>
                            </div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Số chỗ ngồi</p>
                            <p class="text-base font-black text-gray-900 dark:text-white">{{ $vehicle->seats ?? '5' }} Chỗ</p>
                        </div>
                        
                        <div class="p-5 rounded-2xl bg-white dark:bg-[#121212] border border-gray-100 dark:border-white/5 shadow-sm hover:shadow-md hover:border-yellow-500/30 transition-all group">
                            <div class="w-10 h-10 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-red-500 mb-3 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-gas-pump"></i>
                            </div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Nhiên liệu</p>
                            <p class="text-base font-black text-gray-900 dark:text-white">{{ $vehicle->fuel ?? 'Xăng' }}</p>
                        </div>
                        
                        <div class="p-5 rounded-2xl bg-white dark:bg-[#121212] border border-gray-100 dark:border-white/5 shadow-sm hover:shadow-md hover:border-yellow-500/30 transition-all group">
                            <div class="w-10 h-10 rounded-full bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center text-purple-500 mb-3 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-gears"></i>
                            </div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Hộp số</p>
                            <p class="text-base font-black text-gray-900 dark:text-white">Tự động</p>
                        </div>
                        
                        <div class="p-5 rounded-2xl bg-white dark:bg-[#121212] border border-gray-100 dark:border-white/5 shadow-sm hover:shadow-md hover:border-yellow-500/30 transition-all group">
                            <div class="w-10 h-10 rounded-full bg-teal-50 dark:bg-teal-900/20 flex items-center justify-center text-teal-500 mb-3 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-snowflake"></i>
                            </div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Tiện nghi</p>
                            <p class="text-base font-black text-gray-900 dark:text-white">Full Option</p>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white dark:bg-[#121212] rounded-3xl p-8 border border-gray-100 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-black text-gray-900 dark:text-white uppercase tracking-wider mb-4 flex items-center gap-2">
                        <span class="w-8 h-1 bg-yellow-500 rounded-full"></span> Mô tả chi tiết
                    </h3>
                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-400 text-sm leading-7">
                        {!! nl2br(e($vehicle->description ?? 'Đang cập nhật mô tả cho dòng xe này...')) !!}
                    </div>
                </div>

                
                <div id="reviews" class="bg-white dark:bg-[#121212] rounded-3xl p-8 border border-gray-100 dark:border-white/5 shadow-sm">
                    <div class="flex items-center justify-between mb-8 pb-8 border-b border-gray-100 dark:border-gray-800">
                        <div>
                            <h3 class="text-2xl font-black text-gray-900 dark:text-white">Đánh giá & Nhận xét</h3>
                            <p class="text-sm text-gray-500 mt-1">Dựa trên trải nghiệm thực tế của khách hàng</p>
                        </div>
                        <div class="text-center bg-gray-50 dark:bg-gray-800 px-6 py-3 rounded-2xl">
                            <div class="text-3xl font-black text-yellow-500 flex items-center justify-center gap-1">
                                {{ number_format($vehicle->average_rating, 1) }} <i class="fa-solid fa-star text-xl"></i>
                            </div>
                            <div class="text-xs font-bold text-gray-400 uppercase mt-1">{{ $vehicle->reviews->count() }} lượt đánh giá</div>
                        </div>
                    </div>

                    
                    <div class="space-y-6">
                        @forelse($vehicle->reviews as $review)
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-300 font-black text-lg shadow-inner">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-grow bg-gray-50 dark:bg-[#1a1a1a] p-5 rounded-2xl rounded-tl-none border border-gray-100 dark:border-white/5">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-bold text-gray-900 dark:text-white text-sm">{{ $review->user->name }}</h4>
                                            <div class="flex text-yellow-400 text-[10px] mt-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star {{ $i <= $review->rating ? '' : 'text-gray-300 dark:text-gray-700' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <span class="text-xs font-medium text-gray-400">{{ $review->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm italic">"{{ $review->comment }}"</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-300 mb-4">
                                    <i class="fa-regular fa-comment text-2xl"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400">Chưa có đánh giá nào cho xe này.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            
            <div class="lg:col-span-4 animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="sticky top-24 space-y-6">
                    
                    
                    <div class="relative overflow-hidden rounded-[2rem] bg-white dark:bg-[#121212] border border-gray-100 dark:border-white/10 shadow-2xl dark:shadow-[0_0_40px_rgba(0,0,0,0.3)]">
                        
                        
                        <div class="absolute top-0 right-0 w-40 h-40 bg-yellow-500/10 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none"></div>

                        <div class="p-8 relative z-10">
                            <p class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-2">{{ $vehicle->brand->name ?? 'LUXURY CAR' }}</p>
                            <h1 class="text-3xl font-black text-gray-900 dark:text-white leading-tight mb-6">{{ $vehicle->name }}</h1>
                            
                            
                            <div class="flex items-end gap-2 mb-8 pb-8 border-b border-gray-100 dark:border-white/5">
                                <span class="text-4xl font-black text-blue-600 dark:text-yellow-500">{{ number_format($vehicle->price) }}</span>
                                <div class="flex flex-col mb-1">
                                    <span class="text-xs font-bold text-blue-600 dark:text-yellow-500">VNĐ</span>
                                    <span class="text-xs text-gray-400">/ngày</span>
                                </div>
                            </div>

                            
                            <div class="space-y-4 mb-8">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-500 text-xs">
                                        <i class="fa-solid fa-shield-halved"></i>
                                    </div>
                                    <span class="text-sm text-gray-600 dark:text-gray-300 font-medium">Bảo hiểm chuyến đi 100%</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-500 text-xs">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                    <span class="text-sm text-gray-600 dark:text-gray-300 font-medium">Hỗ trợ sự cố 24/7</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-500 text-xs">
                                        <i class="fa-solid fa-file-contract"></i>
                                    </div>
                                    <span class="text-sm text-gray-600 dark:text-gray-300 font-medium">Thủ tục nhanh gọn</span>
                                </div>
                            </div>

                            
                            @if($vehicle->status == 'available')
                                <a href="{{ route('bookings.create', $vehicle->id) }}" class="group relative block w-full overflow-hidden rounded-xl bg-gray-900 dark:bg-yellow-500 py-4 text-center shadow-lg transition-transform active:scale-95">
                                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-shimmer"></div>
                                    <span class="relative text-sm font-black uppercase tracking-widest text-white dark:text-black">
                                        Đặt Xe Ngay <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                                    </span>
                                </a>
                                <p class="text-center text-[10px] text-gray-400 mt-3">Không cần thanh toán ngay</p>
                            @else
                                <button disabled class="block w-full py-4 bg-gray-100 dark:bg-white/5 text-gray-400 font-bold text-center rounded-xl cursor-not-allowed border border-gray-200 dark:border-white/5">
                                    TẠM THỜI HẾT XE
                                </button>
                                <p class="text-center text-xs text-red-500 mt-3 font-bold flex items-center justify-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i> Xe đang được khách khác thuê
                                </p>
                            @endif
                        </div>
                    </div>

                    
                    <div class="bg-blue-600 dark:bg-[#1a1a1a] rounded-[2rem] p-6 text-white relative overflow-hidden shadow-lg border border-blue-500 dark:border-white/10 group">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full blur-2xl -mr-5 -mt-5 group-hover:scale-150 transition-transform duration-700"></div>
                        
                        <div class="relative z-10 flex items-center gap-4">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center text-2xl">
                                <i class="fa-solid fa-headset"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold opacity-80 uppercase mb-1">Tổng đài hỗ trợ</p>
                                <a href="tel:19001000" class="text-2xl font-black tracking-wider hover:text-yellow-400 transition">1900 1000</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
    @keyframes shimmer {
        100% { transform: translateX(100%); }
    }
    .animate-shimmer {
        animation: shimmer 1.5s infinite;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0; 
    }
</style>
@endsection