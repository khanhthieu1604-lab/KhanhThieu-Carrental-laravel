@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-black py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-black mb-4 text-gray-900 dark:text-white">
                Thông Báo <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">của bạn</span>
            </h1>
            <p class="text-gray-600 dark:text-gray-400">Theo dõi các thông báo về đặt xe và thanh toán</p>
        </div>

        {{-- Actions --}}
        @if($notifications->total() > 0)
        <div class="flex gap-4 mb-6">
            <form action="{{ route('notifications.read-all') }}" method="POST">
                @csrf
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-colors">
                    <i class="fa-solid fa-check-double mr-2"></i> Đánh dấu tất cả là đã đọc
                </button>
            </form>
        </div>
        @endif

        {{-- Notifications List --}}
        <div class="space-y-4">
            @forelse($notifications as $notification)
            <div class="bg-white dark:bg-gray-900 rounded-2xl border {{ $notification->read_at ? 'border-gray-100 dark:border-gray-800 opacity-75' : 'border-blue-200 dark:border-blue-900' }} overflow-hidden transition-all hover:shadow-lg">
                <div class="p-6">
                    <div class="flex gap-4">
                        {{-- Icon --}}
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 rounded-2xl {{ $notification->read_at ? 'bg-gray-100 dark:bg-gray-800' : 'bg-gradient-to-br from-blue-500 to-purple-500' }} flex items-center justify-center">
                                @if(str_contains($notification->type, 'PaymentReceived'))
                                <i class="fa-solid fa-dollar-sign {{ $notification->read_at ? 'text-gray-400' : 'text-white' }} text-xl"></i>
                                @elseif(str_contains($notification->type, 'BookingConfirmed'))
                                <i class="fa-solid fa-check {{ $notification->read_at ? 'text-gray-400' : 'text-white' }} text-xl"></i>
                                @elseif(str_contains($notification->type, 'BookingReminder'))
                                <i class="fa-solid fa-clock {{ $notification->read_at ? 'text-gray-400' : 'text-white' }} text-xl"></i>
                                @else
                                <i class="fa-solid fa-bell {{ $notification->read_at ? 'text-gray-400' : 'text-white' }} text-xl"></i>
                                @endif
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-2">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $notification->data['message'] ?? 'Thông báo mới' }}
                                </h3>
                                @if(!$notification->read_at)
                                <span class="flex-shrink-0 w-3 h-3 bg-blue-500 rounded-full"></span>
                                @endif
                            </div>

                            {{-- Details --}}
                            @if(isset($notification->data['booking_id']))
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                <i class="fa-solid fa-car mr-1"></i> Đơn đặt xe #{{ $notification->data['booking_id'] }}
                                @if(isset($notification->data['vehicle_name']))
                                - {{ $notification->data['vehicle_name'] }}
                                @endif
                            </p>
                            @endif

                            {{-- Metadata --}}
                            <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 dark:text-gray-500">
                                <span>
                                    <i class="fa-solid fa-clock mr-1"></i> {{ $notification->created_at->diffForHumans() }}
                                </span>
                                @if($notification->read_at)
                                <span>
                                    <i class="fa-solid fa-check mr-1"></i> Đã đọc {{ $notification->read_at->diffForHumans() }}
                                </span>
                                @endif
                            </div>

                            {{-- Actions --}}
                            <div class="flex gap-2 mt-4">
                                @if(isset($notification->data['booking_id']))
                                <a href="{{ route('bookings.show', $notification->data['booking_id']) }}"
                                    class="px-4 py-2 bg-blue-600 text-white font-bold text-sm rounded-lg hover:bg-blue-700 transition-colors">
                                    Xem đơn hàng
                                </a>
                                @endif

                                @if(!$notification->read_at)
                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 border-2 border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                        Đánh dấu đã đọc
                                    </button>
                                </form>
                                @endif

                                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 font-bold text-sm rounded-lg transition-colors"
                                        onclick="return confirm('Xóa thông báo này?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            {{-- Empty State --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center">
                    <i class="fa-solid fa-inbox text-4xl text-white"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2">Chưa có thông báo</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Bạn sẽ nhận được thông báo về đặt xe và thanh toán tại đây</p>
                <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:scale-105 transition-transform">
                    Tìm xe ngay
                </a>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($notifications->hasPages())
        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
        @endif
    </div>
</div>

@if(session('success'))
<script>
    anime({
        targets: '.bg-white',
        scale: [0.95, 1],
        opacity: [0, 1],
        duration: 600,
        delay: anime.stagger(100),
        easing: 'easeOutElastic(1, .6)'
    });
</script>
@endif
@endsection