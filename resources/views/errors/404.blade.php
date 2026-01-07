@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 p-4">
    <div class="text-center">
        <div class="inline-flex items-center justify-center w-24 h-24 mb-6 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600">
            <i class="fa-solid fa-car-crash text-5xl"></i>
        </div>
        
        <h1 class="text-6xl font-bold text-gray-800 dark:text-gray-200 mb-4">404</h1>
        <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-300 mb-2">Trang không tồn tại</h2>
        <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto">
            Có vẻ như chiếc xe bạn đang tìm đã lăn bánh đi nơi khác hoặc đường dẫn này không tồn tại.
        </p>

        <a href="{{ route('vehicles.index') }}" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-bold transition shadow-lg transform hover:-translate-y-1 inline-flex items-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> Quay về tìm xe khác
        </a>
    </div>
</div>
@endsection