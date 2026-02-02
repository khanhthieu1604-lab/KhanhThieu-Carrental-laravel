<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bookings Report - Thiuu Rental</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            background: #1a1a1a;
            color: white;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .header p {
            font-size: 10px;
            margin-top: 10px;
            opacity: 0.8;
        }

        .summary {
            background: #f5f5f5;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .summary-item {
            text-align: center;
        }

        .summary-item .label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .summary-item .value {
            font-size: 20px;
            font-weight: bold;
            color: #1a1a1a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #1a1a1a;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            font-weight: bold;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 11px;
        }

        tr:hover {
            background: #f9f9f9;
        }

        .status {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-confirmed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-completed {
            background: #e0e7ff;
            color: #3730a3;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #eee;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>THIUU RENTAL</h1>
        <p>Báo Cáo Đặt Xe | {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="summary">
        <div class="summary-grid">
            <div class="summary-item">
                <div class="label">Tổng Đơn</div>
                <div class="value">{{ count($bookings) }}</div>
            </div>
            <div class="summary-item">
                <div class="label">Tổng Doanh Thu</div>
                <div class="value">{{ number_format($totalRevenue) }} đ</div>
            </div>
            <div class="summary-item">
                <div class="label">Doanh Thu TB</div>
                <div class="value">{{ count($bookings) > 0 ? number_format($totalRevenue / count($bookings)) : 0 }} đ</div>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách Hàng</th>
                <th>Xe</th>
                <th>Ngày Thuê</th>
                <th>Số Ngày</th>
                <th>Tổng Tiền</th>
                <th>Trạng Thái</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td>#{{ $booking->id }}</td>
                <td>
                    <strong>{{ $booking->user->name }}</strong><br>
                    <small>{{ $booking->user->email }}</small>
                </td>
                <td>{{ $booking->vehicle->name }}</td>
                <td>{{ $booking->start_date->format('d/m/Y') }}</td>
                <td>{{ $booking->start_date->diffInDays($booking->end_date) }} ngày</td>
                <td><strong>{{ number_format($booking->total_price) }} đ</strong></td>
                <td>
                    <span class="status status-{{ $booking->status }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px; color: #999;">
                    Không có dữ liệu
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Thiuu Rental</strong> - Elite Car Rental Service</p>
        <p>123 Đại Lộ Nguyễn Huệ, Quận 1, TP.HCM | Hotline: 0909.123.456</p>
        <p style="margin-top: 10px;">© {{ date('Y') }} Thiuu Rental. All Rights Reserved.</p>
    </div>
</body>

</html>