@extends('layouts.app')

@section('title', 'Lịch sử thuê xe')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10">
        
        <h2 class="fw-bold mb-4 text-primary">
            <i class="fa-solid fa-clock-rotate-left me-2"></i>Lịch sử thuê xe
        </h2>

        
        @if(isset($rentals) && $rentals->count() > 0)
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase small fw-bold text-muted">
                            <tr>
                                <th class="py-3 ps-4">Xe thuê</th>
                                <th class="py-3">Thời gian</th>
                                <th class="py-3">Chi tiết</th>
                                <th class="py-3">Tổng tiền</th>
                                <th class="py-3">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rentals as $rental)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            
                                            <div class="rounded-3 bg-light d-flex align-items-center justify-content-center fw-bold text-muted border" 
                                                 style="width: 60px; height: 40px; font-size: 10px;">
                                                <i class="fa-solid fa-car"></i>
                                            </div>
                                            
                                            <div>
                                                <div class="fw-bold text-dark">{{ $rental->vehicle->name ?? 'Xe không tồn tại' }}</div>
                                                <div class="small text-muted">{{ $rental->vehicle->brand ?? '' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small">
                                            <div><i class="fa-regular fa-calendar-check me-1 text-success"></i> {{ \Carbon\Carbon::parse($rental->start_date)->format('d/m/Y') }}</div>
                                            <div><i class="fa-regular fa-calendar-xmark me-1 text-danger"></i> {{ \Carbon\Carbon::parse($rental->end_date)->format('d/m/Y') }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border fw-normal">{{ $rental->total_days }} ngày</span>
                                    </td>
                                    <td class="fw-bold text-primary">
                                        {{ number_format($rental->total_price) }}đ
                                    </td>
                                    <td>
                                        @if($rental->status == 'pending')
                                            <span class="badge bg-warning text-dark bg-opacity-25 border border-warning px-3 py-2 rounded-pill">
                                                <i class="fa-solid fa-hourglass-half me-1"></i> Chờ duyệt
                                            </span>
                                        @elseif($rental->status == 'approved')
                                            <span class="badge bg-success bg-opacity-25 text-success border border-success px-3 py-2 rounded-pill">
                                                <i class="fa-solid fa-check me-1"></i> Đã duyệt
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">{{ $rental->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            
            <div class="text-center py-5">
                <div class="mb-3 display-1 text-muted opacity-25"><i class="fa-solid fa-clipboard-list"></i></div>
                <h4 class="text-muted">Bạn chưa có đơn thuê nào!</h4>
                <p class="text-secondary">Hãy chọn một chiếc xe ưng ý và trải nghiệm ngay.</p>
                <a href="{{ route('vehicles.index') }}" class="btn btn-primary mt-2 rounded-pill px-4 shadow-sm">
                    <i class="fa-solid fa-magnifying-glass me-2"></i>Tìm xe ngay
                </a>
            </div>
        @endif

    </div>
</div>

@endsection