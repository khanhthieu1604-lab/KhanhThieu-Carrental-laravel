@extends('layouts.app')

@section('content')
<div class="bg-gray-100 dark:bg-[#0a0a0a] min-h-screen py-8 font-sans text-sm">
    <div class="container mx-auto px-4 max-w-6xl">

        
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.vehicles.index') }}" class="w-10 h-10 flex items-center justify-center bg-white dark:bg-[#121212] rounded-full shadow hover:bg-gray-50 dark:hover:bg-zinc-800 text-gray-600 dark:text-gray-300 transition">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-black text-gray-800 dark:text-white uppercase">Quản lý Xe: {{ $vehicle->name }}</h1>
                <p class="text-xs text-gray-500 font-bold">
                    {{ $vehicle->brand->name ?? 'Hãng khác' }} • {{ $vehicle->type }} 
                    <span class="mx-2">|</span> 
                    Trạng thái: 
                    <span class="{{ $vehicle->status == 'available' ? 'text-green-600' : 'text-red-500' }}">
                        {{ strtoupper($vehicle->status) }}
                    </span>
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-[#121212] p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 sticky top-24">
                    <h3 class="font-black text-lg text-gray-800 dark:text-white mb-4 flex items-center gap-2 uppercase">
                        <i class="fa-solid fa-wrench text-orange-500"></i> Thêm phiếu bảo trì
                    </h3>

                    <form action="{{ route('admin.maintenance.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase mb-1">Loại bảo trì</label>
                            <select name="type" class="w-full bg-gray-50 dark:bg-zinc-900 border border-gray-200 dark:border-zinc-700 rounded-lg p-3 text-sm focus:outline-none focus:border-orange-500 dark:text-white font-medium">
                                <option value="Bảo dưỡng định kỳ">Bảo dưỡng định kỳ</option>
                                <option value="Sửa chữa hư hỏng">Sửa chữa hư hỏng</option>
                                <option value="Thay dầu / Nhớt">Thay dầu / Nhớt</option>
                                <option value="Đăng kiểm">Đăng kiểm</option>
                                <option value="Rửa xe / Dọn nội thất">Rửa xe / Dọn nội thất</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase mb-1">Chi phí (VNĐ)</label>
                            <input type="number" name="cost" placeholder="0" class="w-full bg-gray-50 dark:bg-zinc-900 border border-gray-200 dark:border-zinc-700 rounded-lg p-3 text-sm focus:outline-none focus:border-orange-500 dark:text-white font-bold" required>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase mb-1">Ngày thực hiện</label>
                            <input type="date" name="maintenance_date" value="{{ date('Y-m-d') }}" class="w-full bg-gray-50 dark:bg-zinc-900 border border-gray-200 dark:border-zinc-700 rounded-lg p-3 text-sm focus:outline-none focus:border-orange-500 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase mb-1">Ghi chú chi tiết</label>
                            <textarea name="description" rows="3" placeholder="Chi tiết các hạng mục đã làm..." class="w-full bg-gray-50 dark:bg-zinc-900 border border-gray-200 dark:border-zinc-700 rounded-lg p-3 text-sm focus:outline-none focus:border-orange-500 dark:text-white"></textarea>
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-gray-900 hover:bg-black dark:bg-white dark:text-black dark:hover:bg-gray-200 text-white font-black rounded-xl uppercase text-xs transition shadow-lg">
                            Lưu phiếu
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="lg:col-span-2 space-y-6">
                
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-red-50 dark:bg-red-900/10 p-5 rounded-2xl border border-red-100 dark:border-red-900/20">
                        <p class="text-[10px] text-red-500 uppercase font-black">Tổng chi phí</p>
                        
                        <p class="text-2xl font-black text-red-600 dark:text-red-500 mt-1">{{ number_format($vehicle->maintenances->sum('cost')) }}đ</p>
                    </div>
                    <div class="bg-blue-50 dark:bg-blue-900/10 p-5 rounded-2xl border border-blue-100 dark:border-blue-900/20">
                        <p class="text-[10px] text-blue-500 uppercase font-black">Số lần bảo trì</p>
                        <p class="text-2xl font-black text-blue-600 dark:text-blue-500 mt-1">{{ $vehicle->maintenances->count() }} lần</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#121212] rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-zinc-900">
                        <h3 class="font-black text-gray-800 dark:text-white uppercase text-xs">Lịch sử bảo trì</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-white dark:bg-[#121212] text-[10px] uppercase text-gray-400 font-bold border-b border-gray-100 dark:border-gray-800">
                                <tr>
                                    <th class="px-5 py-4">Ngày</th>
                                    <th class="px-5 py-4">Hạng mục</th>
                                    <th class="px-5 py-4">Chi tiết</th>
                                    <th class="px-5 py-4 text-right">Chi phí</th>
                                    <th class="px-5 py-4"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-zinc-800">
                                @forelse($vehicle->maintenances()->latest()->get() as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-900/50 transition">
                                    <td class="px-5 py-4 text-gray-600 dark:text-gray-400 font-medium whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($item->maintenance_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase border
                                            {{ $item->type == 'Sửa chữa hư hỏng' ? 'bg-red-50 text-red-600 border-red-100' : 'bg-green-50 text-green-600 border-green-100' }}">
                                            {{ $item->type }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-gray-500 dark:text-gray-400 text-xs">{{ $item->description ?? '-' }}</td>
                                    <td class="px-5 py-4 text-right font-black text-gray-800 dark:text-white">{{ number_format($item->cost) }}đ</td>
                                    <td class="px-5 py-4 text-right">
                                        <form action="{{ route('admin.maintenance.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Xóa phiếu này?')">
                                            @csrf @method('DELETE')
                                            <button class="w-8 h-8 rounded-full hover:bg-red-50 text-gray-300 hover:text-red-500 transition flex items-center justify-center">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-8 text-center text-gray-400 italic text-xs">Chưa có lịch sử bảo trì nào.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection