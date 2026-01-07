@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold dark:text-white mb-8"><i class="fa-solid fa-crown text-purple-500 mr-2"></i>QUẢN TRỊ VIÊN HỆ THỐNG</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border-t-4 border-purple-600">
            <h3 class="font-bold mb-4 dark:text-white">Tạo Admin mới</h3>
            <form action="{{ route('master.admins.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase">Tên hiển thị</label>
                    <input type="text" name="name" class="w-full border-gray-300 dark:bg-gray-700 dark:text-white rounded mt-1">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase">Email</label>
                    <input type="email" name="email" class="w-full border-gray-300 dark:bg-gray-700 dark:text-white rounded mt-1">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase">Mật khẩu</label>
                    <input type="password" name="password" class="w-full border-gray-300 dark:bg-gray-700 dark:text-white rounded mt-1">
                </div>
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded transition">TẠO TÀI KHOẢN</button>
            </form>
        </div>

        <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
            <h3 class="font-bold mb-4 dark:text-white">Danh sách Admin</h3>
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase border-b dark:border-gray-700">
                        <th class="pb-3">Tên</th>
                        <th class="pb-3">Email</th>
                        <th class="pb-3">Ngày tạo</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-700">
                    @foreach($admins as $admin)
                    <tr class="text-sm dark:text-gray-300">
                        <td class="py-4 font-bold">{{ $admin->name }}</td>
                        <td class="py-4">{{ $admin->email }}</td>
                        <td class="py-4">{{ $admin->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection