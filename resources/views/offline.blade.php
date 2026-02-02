@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 px-4">
    <div class="text-center text-white max-w-lg">
        <div class="w-32 h-32 mx-auto mb-8 rounded-full bg-white/10 backdrop-blur-lg flex items-center justify-center">
            <i class="fa-solid fa-wifi-slash text-6xl"></i>
        </div>
        <h1 class="text-4xl font-black mb-4">Bạn offline rồi!</h1>
        <p class="text-xl mb-8 opacity-90">
            Vui lòng kiểm tra kết nối internet và thử lại
        </p>
        <button onclick="location.reload()" class="px-8 py-4 bg-white text-purple-600 font-bold rounded-2xl hover:scale-105 transition-transform">
            Thử lại
        </button>
    </div>
</div>
@endsection