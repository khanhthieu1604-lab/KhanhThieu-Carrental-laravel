@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 p-4">
    <div class="text-center">
        <div class="inline-flex items-center justify-center w-24 h-24 mb-6 rounded-full bg-red-100 dark:bg-red-900/30 text-red-600">
            <i class="fa-solid fa-user-lock text-5xl"></i>
        </div>
        
        <h1 class="text-6xl font-bold text-gray-800 dark:text-gray-200 mb-4">403</h1>
        <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-300 mb-2">Truy cập bị từ chối</h2>
        <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto">
            Xin lỗi, bạn không có quyền truy cập vào khu vực quản trị này. Vui lòng quay lại trang chủ hoặc đăng nhập bằng tài khoản Admin.
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('vehicles.index') }}" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition shadow-lg flex items-center">
                <i class="fa-solid fa-house mr-2"></i> Trang chủ
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-6 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg font-medium transition flex items-center">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Đăng xuất
                </button>
            </form>
        </div>
    </div>
</div>
@endsection