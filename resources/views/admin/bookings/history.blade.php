@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-blue-900 mb-2 font-heading">Lịch sử đặt xe</h1>
        <p class="text-gray-500 mb-8">Theo dõi trạng thái các chuyến đi của bạn.</p>

        @if($bookings->count() > 0)
            <div class="grid gap-6">
                @foreach($bookings as $booking)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden flex flex-col md:flex-row hover:shadow-md transition">
                    <div class="w-full md:w-1/4 bg-gray-100 relative">
                        @if($booking->vehicle->image)
                            <img src="{{ asset($booking->vehicle->image) }}" class="w-full h-full object-cover absolute inset-0">
                        @else
                            <div class="flex items-center justify-center h-40 text-gray-400"><i class="fa-solid fa-car text-3xl"></i></div>
                        @endif
                    </div>

                    <div class="p-6 flex-grow flex flex-col md:flex-row justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="text-xl font-bold text-gray-900">{{ $booking->vehicle->name }}</h3>
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded border border-gray-200">{{ $booking->vehicle->brand }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mb-4">Mã đơn: <span class="font-mono text-gray-700 font-bold">#{{ $booking->id }}</span></p>

                            <div class="space-y-1 text-sm text-gray-600">
                                <div class="flex items-center gap-2"><i class="fa-regular fa-calendar text-blue-500"></i> Nhận: {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}</div>
                                <div class="flex items-center gap-2"><i class="fa-solid fa-arrow-right-long text-gray-300 pl-5"></i> Trả: {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}</div>
                            </div>
                        </div>

                        <div class="text-left md:text-right flex flex-col justify-center">
                            <div class="text-xs text-gray-400 uppercase mb-1">Tổng thanh toán</div>
                            <div class="text-2xl font-bold text-blue-800 mb-3">{{ number_format($booking->total_price) }}đ</div>
                            
                            <div>
                                @if($booking->status == 'pending')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-pulse"></span> Chờ xác nhận
                                    </span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                        <i class="fa-solid fa-check mr-2"></i> Đặt thành công
                                    </span>
                                @elseif($booking->status == 'cancelled')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                        <i class="fa-solid fa-xmark mr-2"></i> Đã hủy
                                    </span>
                                @elseif($booking->status == 'completed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800 border border-gray-200">
                                        <i class="fa-solid fa-flag-checkered mr-2"></i> Hoàn thành
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-8">
                {{ $bookings->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-lg border border-gray-200 shadow-sm">
                <div class="w-20 h-20 bg-blue-50 text-blue-300 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-clipboard-list text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Bạn chưa có chuyến đi nào</h3>
                <p class="text-gray-500 mb-6">Hãy chọn ngay một chiếc xe ưng ý cho hành trình sắp tới.</p>
                <a href="{{ route('vehicles.index') }}" class="inline-block bg-blue-800 text-white font-bold py-3 px-8 rounded hover:bg-blue-900 transition shadow">
                    Tìm xe ngay
                </a>
            </div>
        @endif
    </div>
</div>
@endsection