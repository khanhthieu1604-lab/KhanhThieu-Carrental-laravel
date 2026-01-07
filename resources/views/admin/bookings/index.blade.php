@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="mb-8">
        <h2 class="text-2xl font-bold dark:text-white uppercase tracking-wider">Quản lý Đơn thuê xe</h2>
        <p class="text-gray-500 text-sm">Xem và phê duyệt các yêu cầu đặt xe từ khách hàng</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden border dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs font-black">
                    <tr>
                        <th class="px-6 py-4">Mã Đơn</th>
                        <th class="px-6 py-4">Khách hàng</th>
                        <th class="px-6 py-4">Thông tin xe</th>
                        <th class="px-6 py-4">Thời gian thuê</th>
                        <th class="px-6 py-4">Tổng tiền</th>
                        <th class="px-6 py-4">Trạng thái</th>
                        <th class="px-6 py-4 text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-700">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition text-sm">
                        <td class="px-6 py-4 font-bold text-blue-600">#{{ $booking->id }}</td>
                        <td class="px-6 py-4">
                            <div class="dark:text-white font-semibold">{{ $booking->user->name }}</div>
                            <div class="text-[10px] text-gray-400">{{ $booking->user->phone }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="dark:text-white">{{ $booking->vehicle->name }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase">{{ $booking->vehicle->brand }}</div>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400">
                            {{ $booking->start_date->format('d/m/Y') }} - {{ $booking->end_date->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 font-black text-gray-900 dark:text-white">
                            {{ number_format($booking->total_price) }}đ
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'confirmed' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                    'completed' => 'bg-blue-100 text-blue-700',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $statusClasses[$booking->status] }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.bookings.update_status', $booking->id) }}" method="POST" class="inline-flex gap-2">
                                @csrf @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-xs border-gray-300 rounded dark:bg-gray-700 dark:text-white">
                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Xác nhận</option>
                                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Hủy đơn</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500 italic">Chưa có đơn hàng nào được đặt.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-6 flex justify-center">
        {{ $bookings->links() }}
    </div>
</div>
@endsection