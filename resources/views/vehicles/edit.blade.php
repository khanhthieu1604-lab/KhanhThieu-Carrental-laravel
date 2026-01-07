@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.vehicles.index') }}" class="text-gray-500 hover:text-gray-900"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
            <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Chỉnh sửa thông tin xe</h2>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tên xe <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $vehicle->name) }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-800">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Hãng xe</label>
                                <select name="brand" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-800 bg-white">
                                    <option value="Toyota" {{ $vehicle->brand == 'Toyota' ? 'selected' : '' }}>Toyota</option>
                                    <option value="Honda" {{ $vehicle->brand == 'Honda' ? 'selected' : '' }}>Honda</option>
                                    <option value="Mazda" {{ $vehicle->brand == 'Mazda' ? 'selected' : '' }}>Mazda</option>
                                    <option value="Mercedes" {{ $vehicle->brand == 'Mercedes' ? 'selected' : '' }}>Mercedes</option>
                                    <option value="VinFast" {{ $vehicle->brand == 'VinFast' ? 'selected' : '' }}>VinFast</option>
                                    <option value="Hyundai" {{ $vehicle->brand == 'Hyundai' ? 'selected' : '' }}>Hyundai</option>
                                    <option value="Kia" {{ $vehicle->brand == 'Kia' ? 'selected' : '' }}>Kia</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Loại xe</label>
                                <select name="type" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-800 bg-white">
                                    <option value="Sedan" {{ $vehicle->type == 'Sedan' ? 'selected' : '' }}>Sedan (4 chỗ)</option>
                                    <option value="SUV" {{ $vehicle->type == 'SUV' ? 'selected' : '' }}>SUV (7 chỗ)</option>
                                    <option value="Limousine" {{ $vehicle->type == 'Limousine' ? 'selected' : '' }}>Limousine</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Giá thuê / ngày (VNĐ) <span class="text-red-500">*</span></label>
                            <input type="number" name="rent_price_per_day" value="{{ old('rent_price_per_day', $vehicle->rent_price_per_day) }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-800 font-bold text-blue-800">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Trạng thái</label>
                            <select name="status" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-800 bg-white">
                                <option value="available" {{ $vehicle->status == 'available' ? 'selected' : '' }}>🟢 Sẵn sàng</option>
                                <option value="rented" {{ $vehicle->status == 'rented' ? 'selected' : '' }}>🔴 Đang thuê</option>
                                <option value="maintenance" {{ $vehicle->status == 'maintenance' ? 'selected' : '' }}>🔧 Bảo trì</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Hình ảnh hiện tại</label>
                            <div class="border border-gray-200 rounded p-2 bg-gray-50 text-center">
                                @if($vehicle->image)
                                    <img src="{{ asset($vehicle->image) }}" class="h-40 mx-auto object-cover rounded">
                                @else
                                    <span class="text-gray-400">Không có ảnh</span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Thay ảnh mới (Nếu muốn)</label>
                            <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Mô tả chi tiết</label>
                            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-800">{{ old('description', $vehicle->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 mt-6 pt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.vehicles.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded font-bold hover:bg-gray-300 transition">Hủy</a>
                    <button type="submit" class="px-6 py-2 bg-blue-800 text-white rounded font-bold hover:bg-blue-900 transition shadow">
                        <i class="fa-solid fa-save mr-2"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection