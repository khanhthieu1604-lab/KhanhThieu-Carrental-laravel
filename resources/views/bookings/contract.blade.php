<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hợp Đồng Thuê Xe #{{ $booking->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Times New Roman', Times, serif; }
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .a4-page { box-shadow: none; border: none; width: 100%; margin: 0; padding: 0; }
        }
    </style>
</head>
<body class="bg-gray-100 py-10">

    <div class="fixed top-0 left-0 w-full bg-white shadow-md p-3 flex justify-between items-center no-print z-50">
        <div class="font-sans font-bold text-gray-700">
            <span class="text-blue-600">Thiuu Rental</span> Contract Viewer
        </div>
        <div class="flex gap-3">
            <a href="{{ route('bookings.history') }}" class="px-4 py-2 bg-gray-200 text-gray-700 font-sans text-sm rounded hover:bg-gray-300">Quay lại</a>
            <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white font-sans text-sm font-bold rounded hover:bg-blue-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                In Hợp Đồng
            </button>
        </div>
    </div>

    <div class="a4-page w-[210mm] min-h-[297mm] mx-auto bg-white shadow-xl p-[20mm] text-base leading-relaxed text-justify relative mt-8">
        
        <div class="text-center mb-8">
            <h3 class="font-bold uppercase text-lg mb-1">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h3>
            <p class="font-bold underline decoration-1 underline-offset-4">Độc lập - Tự do - Hạnh phúc</p>
        </div>

        <div class="text-center mb-8">
            <h1 class="font-bold uppercase text-2xl mb-2">HỢP ĐỒNG THUÊ XE TỰ LÁI</h1>
            <p class="italic text-sm">Số: HĐ-{{ $booking->id }}/{{ date('Y') }}/TR</p>
            <p class="italic text-sm">Hôm nay, ngày {{ date('d') }} tháng {{ date('m') }} năm {{ date('Y') }}</p>
        </div>

        <div class="mb-6">
            <p>Tại văn phòng Công ty Thiuu Rental, chúng tôi gồm có:</p>
        </div>

        <div class="mb-6">
            <h4 class="font-bold uppercase mb-2">BÊN A: BÊN CHO THUÊ XE (THIUU RENTAL)</h4>
            <table class="w-full">
                <tr>
                    <td class="w-32 font-bold align-top">Đại diện:</td>
                    <td>Ông Lương Khánh Thiệu</td>
                </tr>
                <tr>
                    <td class="font-bold align-top">Chức vụ:</td>
                    <td>Giám đốc điều hành</td>
                </tr>
                <tr>
                    <td class="font-bold align-top">Địa chỉ:</td>
                    <td>123 Đường Lê Lợi, Quận 1, TP. Hồ Chí Minh</td>
                </tr>
                <tr>
                    <td class="font-bold align-top">Điện thoại:</td>
                    <td>0909.123.456</td>
                </tr>
            </table>
        </div>

        <div class="mb-6">
            <h4 class="font-bold uppercase mb-2">BÊN B: BÊN THUÊ XE (KHÁCH HÀNG)</h4>
            <table class="w-full">
                <tr>
                    <td class="w-32 font-bold align-top">Họ và tên:</td>
                    <td class="uppercase font-bold">{{ $booking->user->name }}</td>
                </tr>
                <tr>
                    <td class="font-bold align-top">Email:</td>
                    <td>{{ $booking->user->email }}</td>
                </tr>
                <tr>
                    <td class="font-bold align-top">Điện thoại:</td>
                    <td>{{ $booking->user->phone ?? '....................' }}</td>
                </tr>
                <tr>
                    <td class="font-bold align-top">Địa chỉ:</td>
                    <td>{{ $booking->user->address ?? '..................................................................' }}</td>
                </tr>
            </table>
        </div>

        <div class="mb-4">
            <p>Sau khi bàn bạc, hai bên thống nhất ký kết hợp đồng thuê xe với các điều khoản sau:</p>
        </div>

        <div class="mb-4">
            <h4 class="font-bold mb-1">ĐIỀU 1: ĐỐI TƯỢNG HỢP ĐỒNG</h4>
            <p>Bên A đồng ý cho Bên B thuê xe ô tô với thông tin chi tiết như sau:</p>
            <ul class="list-disc list-inside ml-4 mt-2">
                <li><span class="font-bold">Tên xe:</span> {{ $booking->vehicle->name }}</li>
                <li><span class="font-bold">Loại xe:</span> {{ $booking->vehicle->type }} (5 chỗ)</li>
                
                <li><span class="font-bold">Hãng sản xuất:</span> {{ $booking->vehicle->brand->name ?? 'Xe' }}</li>
                <li><span class="font-bold">Mục đích thuê:</span> Đi lại cá nhân / du lịch / công tác.</li>
            </ul>
        </div>

        <div class="mb-4">
            <h4 class="font-bold mb-1">ĐIỀU 2: THỜI GIAN VÀ GIÁ TRỊ HỢP ĐỒNG</h4>
            <ul class="list-disc list-inside ml-4">
                <li><span class="font-bold">Thời gian nhận xe:</span> {{ \Carbon\Carbon::parse($booking->start_date)->format('H:i - d/m/Y') }}</li>
                <li><span class="font-bold">Thời gian trả xe:</span> {{ \Carbon\Carbon::parse($booking->end_date)->format('H:i - d/m/Y') }}</li>
                
                <li><span class="font-bold">Đơn giá thuê:</span> {{ number_format($booking->vehicle->price) }} VNĐ / ngày</li>
                <li>
                    <span class="font-bold">Tổng giá trị hợp đồng:</span> 
                    <span class="font-bold text-lg border-b border-black">{{ number_format($booking->total_price) }} VNĐ</span>
                </li>
                <li><span class="font-bold">Hình thức thanh toán:</span> Chuyển khoản / Tiền mặt.</li>
                <li><span class="font-bold">Trạng thái:</span> {{ $booking->status == 'confirmed' ? 'Đã đặt cọc / Đã thanh toán' : 'Chờ thanh toán' }}</li>
            </ul>
        </div>

        <div class="mb-6">
            <h4 class="font-bold mb-1">ĐIỀU 3: TRÁCH NHIỆM CỦA CÁC BÊN</h4>
            <p class="mb-1"><span class="font-bold">3.1. Trách nhiệm Bên A:</span> Giao xe đúng chủng loại, chất lượng, đảm bảo an toàn kỹ thuật và giấy tờ pháp lý cần thiết để lưu hành.</p>
            <p><span class="font-bold">3.2. Trách nhiệm Bên B:</span> Sử dụng xe đúng mục đích, tuân thủ luật giao thông đường bộ. Chịu trách nhiệm bồi thường nếu gây ra hư hỏng, mất mát do lỗi chủ quan.</p>
        </div>

        <div class="flex justify-between mt-16 text-center">
            <div class="w-1/2">
                <p class="font-bold uppercase">ĐẠI DIỆN BÊN A</p>
                <p class="italic text-sm">(Ký, ghi rõ họ tên)</p>
                <div class="h-24 flex items-center justify-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e4/Signature_sample.svg/1200px-Signature_sample.svg.png" class="h-12 opacity-50 rotate-[-10deg]">
                </div>
                <p class="font-bold">Lương Khánh Thiệu</p>
            </div>
            <div class="w-1/2">
                <p class="font-bold uppercase">ĐẠI DIỆN BÊN B</p>
                <p class="italic text-sm">(Ký, ghi rõ họ tên)</p>
                <div class="h-24">
                    </div>
                <p class="font-bold uppercase">{{ $booking->user->name }}</p>
            </div>
        </div>

        <div class="absolute bottom-10 left-0 w-full text-center text-xs italic text-gray-400">
            Hợp đồng được tạo tự động bởi hệ thống Thiuu Rental vào lúc {{ date('H:i d/m/Y') }}
        </div>

    </div>

</body>
</html>