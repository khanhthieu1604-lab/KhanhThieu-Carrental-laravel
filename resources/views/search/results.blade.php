@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-black py-12">
    <div class="container mx-auto px-4">
        {{-- Search Header --}}
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-black mb-4 text-gray-900 dark:text-white">
                Kết quả tìm kiếm
                @if($query)
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">"{{ $query }}"</span>
                @endif
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                Tìm thấy {{ $vehicles->total() }} xe phù hợp
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            {{-- Filters Sidebar --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-100 dark:border-gray-800 sticky top-24">
                    <h2 class="text-xl font-black mb-6 text-gray-900 dark:text-white">Bộ lọc</h2>

                    <form action="{{ route('search') }}" method="GET" class="space-y-6">
                        {{-- Search Query --}}
                        <input type="hidden" name="q" value="{{ $query }}">

                        {{-- Brand Filter --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Hãng xe</label>
                            <select name="brand" class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                                <option value="">Tất cả</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand }}" {{ ($filters['brand'] ?? '') == $brand ? 'selected' : '' }}>
                                    {{ $brand }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Type Filter --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Loại xe</label>
                            <select name="type" class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                                <option value="">Tất cả</option>
                                @foreach($types as $type)
                                <option value="{{ $type }}" {{ ($filters['type'] ?? '') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Price Range --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Giá thuê (VNĐ/ngày)</label>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="number" name="min_price" placeholder="Từ" value="{{ $filters['min_price'] ?? '' }}"
                                    class="px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm">
                                <input type="number" name="max_price" placeholder="Đến" value="{{ $filters['max_price'] ?? '' }}"
                                    class="px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm">
                            </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="space-y-2">
                            <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:scale-105 transition-transform">
                                Áp dụng bộ lọc
                            </button>
                            <a href="{{ route('search') }}" class="block w-full px-6 py-3 border-2 border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-center">
                                Xóa bộ lọc
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Results Grid --}}
            <div class="lg:col-span-3">
                @if($vehicles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($vehicles as $vehicle)
                    <div class="bg-white dark:bg-gray-900 rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-800 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 group">
                        {{-- Image --}}
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img src="{{ $vehicle->image_url }}"
                                alt="{{ $vehicle->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                onerror="this.src='https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=800'">

                            {{-- Status Badge --}}
                            <div class="absolute top-4 right-4 px-3 py-1 rounded-full {{ $vehicle->status == 'available' ? 'bg-green-500' : 'bg-red-500' }} text-white text-xs font-bold">
                                {{ $vehicle->status == 'available' ? 'Sẵn sàng' : 'Đã thuê' }}
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6">
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
                                {{ $vehicle->brand?->name ?? 'N/A' }}
                            </p>
                            <h3 class="text-xl font-black mb-2 text-gray-900 dark:text-white">
                                {{ $vehicle->name }}
                            </h3>
                            <div class="flex items-center gap-2 mb-4 text-sm text-gray-600 dark:text-gray-400">
                                <span class="px-2 py-1 bg-gray-100 dark:bg-gray-800 rounded">{{ $vehicle->type }}</span>
                            </div>
                            <div class="flex items-end justify-between">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Giá thuê</p>
                                    <p class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-yellow-600 to-yellow-500">
                                        {{ number_format($vehicle->price) }}đ
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">/ ngày</p>
                                </div>
                                <a href="{{ route('vehicles.show', $vehicle->id) }}"
                                    class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:scale-105 transition-transform text-sm">
                                    Thuê ngay
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($vehicles->hasPages())
                <div class="mt-8">
                    {{ $vehicles->links() }}
                </div>
                @endif

                @else
                {{-- Empty State --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl p-12 text-center">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center">
                        <i class="fa-solid fa-magnifying-glass text-4xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2">Không tìm thấy xe phù hợp</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Thử thay đổi từ khóa hoặc bộ lọc khác
                    </p>
                    <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:scale-105 transition-transform">
                        Xem tất cả xe
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .search-result-card {
        animation: fadeInUp 0.6s ease-out backwards;
    }

    .search-result-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .search-result-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .search-result-card:nth-child(3) {
        animation-delay: 0.3s;
    }
</style>
@endsection