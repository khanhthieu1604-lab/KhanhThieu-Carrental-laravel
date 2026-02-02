@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white dark:bg-black">
    {{-- Hero Section --}}
    <section class="relative py-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-blue-950/20 dark:via-purple-950/20 dark:to-pink-950/20"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <span class="inline-block px-6 py-3 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 text-white text-xs font-bold uppercase tracking-wider mb-8">
                    Cẩm Nang Xe Sang
                </span>
                <h1 class="text-5xl md:text-7xl font-black mb-6">
                    <span class="text-gray-900 dark:text-white">BLOG</span>
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"> XE HẠNG SANG</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    Khám phá thế giới xe cao cấp, tips thuê xe, và lifestyle thượng lưu
                </p>
            </div>
        </div>
    </section>

    {{-- Latest Posts --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                {{-- Main Column --}}
                <div class="lg:col-span-2 space-y-12">
                    @php
                    $posts = [
                    [
                    'title' => 'Top 10 Siêu Xe Đáng Thuê Nhất 2026',
                    'excerpt' => 'Khám phá danh sách những mẫu siêu xe được ưa chuộng nhất năm nay, từ Lamborghini Urus đến Ferrari Roma.',
                    'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800',
                    'category' => 'Xe Sang',
                    'date' => '15 Jan 2026',
                    'read_time' => '5 phút đọc',
                    'author' => 'Minh Thiện',
                    ],
                    [
                    'title' => 'Hướng Dẫn Thuê Xe Cưới Hoàn Hảo',
                    'excerpt' => 'Những lưu ý quan trọng khi chọn xe hoa cho ngày trọng đại, từ loại xe đến trang trí và lộ trình.',
                    'image' => 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=800',
                    'category' => 'Sự Kiện',
                    'date' => '12 Jan 2026',
                    'read_time' => '7 phút đọc',
                    'author' => 'Thu Hà',
                    ],
                    [
                    'title' => 'Bí Quyết Chăm Sóc Xe Thuê Như Xe Riêng',
                    'excerpt' => 'Cách sử dụng và bảo quản xe thuê một cách đúng đắn để tránh phát sinh chi phí và đảm bảo an toàn.',
                    'image' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800',
                    'category' => 'Hướng Dẫn',
                    'date' => '10 Jan 2026',
                    'read_time' => '4 phút đọc',
                    'author' => 'Văn Lộc',
                    ],
                    [
                    'title' => 'So Sánh Rolls-Royce vs Bentley: Đâu Là Lựa Chọn Của Bạn?',
                    'excerpt' => 'Phân tích chi tiết hai biểu tượng sang trọng bậc nhất thế giới, giúp bạn chọn được mẫu xe phù hợp.',
                    'image' => 'https://images.unsplash.com/photo-1563720360172-67b8f3dce741?w=800',
                    'category' => 'So Sánh',
                    'date' => '8 Jan 2026',
                    'read_time' => '6 phút đọc',
                    'author' => 'Minh Thiện',
                    ],
                    [
                    'title' => 'Xu Hướng Thuê Xe Cao Cấp 2026',
                    'excerpt' => 'Những xu hướng mới nhất trong ngành cho thuê xe sang: xe điện, công nghệ AI, và dịch vụ cá nhân hóa.',
                    'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800',
                    'category' => 'Xu Hướng',
                    'date' => '5 Jan 2026',
                    'read_time' => '5 phút đọc',
                    'author' => 'Thu Hà',
                    ],
                    ];
                    @endphp

                    @foreach($posts as $post)
                    <article class="group bg-white dark:bg-gray-900 rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-800 hover:shadow-2xl transition-all duration-500">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                            {{-- Image --}}
                            <div class="aspect-[4/3] md:aspect-auto overflow-hidden">
                                <img src="{{ $post['image'] }}"
                                    alt="{{ $post['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                    onerror="this.src='https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800'">
                            </div>

                            {{-- Content --}}
                            <div class="p-8 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-4 mb-4">
                                        <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-bold">
                                            {{ $post['category'] }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $post['date'] }}</span>
                                    </div>

                                    <h2 class="text-2xl font-black mb-4 text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                        {{ $post['title'] }}
                                    </h2>

                                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">
                                        {{ $post['excerpt'] }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                                            {{ substr($post['author'], 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $post['author'] }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $post['read_time'] }}</p>
                                        </div>
                                    </div>

                                    <a href="#" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:scale-105 transition-transform text-sm">
                                        Đọc tiếp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                {{-- Sidebar --}}
                <div class="space-y-8">
                    {{-- Categories --}}
                    <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 border border-gray-100 dark:border-gray-800">
                        <h3 class="text-xl font-black mb-6 text-gray-900 dark:text-white">Chủ Đề</h3>
                        <div class="space-y-3">
                            @foreach(['Xe Sang' => 12, 'Hướng Dẫn' => 8, 'Sự Kiện' => 6, 'So Sánh' => 5, 'Xu Hướng' => 4] as $category => $count)
                            <a href="#" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                                <span class="text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 font-medium">{{ $category }}</span>
                                <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-xs font-bold text-gray-600 dark:text-gray-400">{{ $count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Popular Posts --}}
                    <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 border border-gray-100 dark:border-gray-800">
                        <h3 class="text-xl font-black mb-6 text-gray-900 dark:text-white">Phổ Biến Nhất</h3>
                        <div class="space-y-6">
                            @foreach(['Bí quyết đàm phán giá thuê xe tốt nhất', 'Những sai lầm khi thuê xe cần tránh', 'Review đánh giá Lamborghini Urus'] as $index => $popular)
                            <div class="flex gap-4 group cursor-pointer">
                                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-black text-lg flex-shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors leading-snug">
                                        {{ $popular }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">2 ngày trước</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Newsletter --}}
                    <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-3xl p-8 text-white">
                        <h3 class="text-xl font-black mb-4">Đăng Ký Nhận Tin</h3>
                        <p class="text-sm opacity-90 mb-6">Nhận bài viết mới nhất về xe sang mỗi tuần</p>
                        <input type="email" placeholder="Email của bạn" class="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/30 text-white placeholder-white/60 mb-3">
                        <button class="w-full px-6 py-3 bg-white text-purple-600 font-bold rounded-xl hover:scale-105 transition-transform">
                            Đăng Ký Ngay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection