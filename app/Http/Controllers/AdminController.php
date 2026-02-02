<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Review;
use App\Exports\BookingsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{

    private function checkAdmin()
    {
        if (!Auth::check() || (Auth::user()->role !== 'admin' && Auth::user()->role !== 'master')) {
            return false;
        }
        return true;
    }

    public function stats()
    {
        if (!$this->checkAdmin()) abort(403);

        $revenue = Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price');
        $pendingBookings = Booking::where('status', 'pending')->count();
        $totalVehicles = Vehicle::count();
        $availableCars = Vehicle::where('status', 'available')->count();
        $rentedCars    = Vehicle::where('status', 'rented')->count();
        $totalUsers = User::where('role', 'user')->count();

        // Revenue Chart Data (Last 7 Days)
        $revenueData = [];
        $chartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dayRevenue = Booking::whereIn('status', ['confirmed', 'completed'])
                ->whereDate('created_at', $date)
                ->sum('total_price');

            $revenueData[] = $dayRevenue;
            $chartLabels[] = $date->format('D'); // Mon, Tue...
        }

        return response()->json([
            'revenue' => number_format($revenue),
            'pendingBookings' => $pendingBookings,
            'totalVehicles' => $totalVehicles,
            'availableCars' => $availableCars,
            'rentedCars' => $rentedCars,
            'totalUsers' => $totalUsers,
            'revenueData' => $revenueData,
            'chartLabels' => $chartLabels
        ]);
    }


    public function index()
    {
        if (!$this->checkAdmin()) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập!');
        }


        $revenue = Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price');
        $pendingBookings = Booking::where('status', 'pending')->count();


        $totalVehicles = Vehicle::count();
        $availableCars = Vehicle::where('status', 'available')->count();
        $rentedCars    = Vehicle::where('status', 'rented')->count();


        $totalUsers = User::where('role', 'user')->count();


        $recentBookings = Booking::with(['user', 'vehicle'])
            ->latest()
            ->take(5)
            ->get();


        $allUsers = User::latest()->paginate(10);

        // Revenue Chart Data (Last 7 Days)
        $revenueData = [];
        $chartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dayRevenue = Booking::whereIn('status', ['confirmed', 'completed'])
                ->whereDate('created_at', $date)
                ->sum('total_price');

            $revenueData[] = $dayRevenue;
            $chartLabels[] = $date->format('D'); // Mon, Tue...
        }

        return view('admin.dashboard', compact(
            'revenue',
            'pendingBookings',
            'totalVehicles',
            'availableCars',
            'rentedCars',
            'totalUsers',
            'recentBookings',
            'allUsers',
            'revenueData',
            'chartLabels'
        ));
    }


    public function serviceReviews()
    {
        if (!$this->checkAdmin()) abort(403);

        $reviews = Review::with(['user', 'vehicle'])->latest()->paginate(15);

        return view('admin.reviews.index', compact('reviews'));
    }


    public function updateAbout(Request $request)
    {
        if (!$this->checkAdmin()) abort(403);

        $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_desc' => 'required|string',
            'hero_bg' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($request->hasFile('hero_bg')) {
            $path = $request->file('hero_bg')->store('about', 'public');
        }

        return back()->with('success', 'Đã cập nhật nội dung trang Về chúng tôi thành công!');
    }


    public function updateStatus(Request $request, $id)
    {
        if (!$this->checkAdmin()) abort(403);

        $booking = Booking::findOrFail($id);
        $status = $request->status;

        $booking->update(['status' => $status]);

        if ($status == 'confirmed') {
            $booking->vehicle->update(['status' => 'rented']);
        } elseif ($status == 'completed' || $status == 'cancelled') {
            $booking->vehicle->update(['status' => 'available']);
        }

        return back()->with('success', 'Đã cập nhật trạng thái đơn hàng #' . $id);
    }


    public function usersIndex()
    {
        if (!$this->checkAdmin()) abort(403);

        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }


    public function updateUserRole($id)
    {
        if (!$this->checkAdmin()) abort(403);

        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Bạn không thể thay đổi quyền của chính mình!');
        }


        $user->role = ($user->role === 'admin') ? 'user' : 'admin';
        $user->save();

        return back()->with('success', "Đã thay đổi quyền của {$user->name} thành " . strtoupper($user->role));
    }


    public function deleteUser($id)
    {
        if (!$this->checkAdmin()) abort(403);

        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Bạn không thể xóa chính mình!');
        }

        $user->delete();
        return back()->with('success', 'Đã xóa thành viên khỏi hệ thống.');
    }

    /**
     * Export bookings to Excel
     */
    public function exportExcel(Request $request)
    {
        if (!$this->checkAdmin()) abort(403);

        $filename = 'bookings_' . now()->format('Y-m-d_His') . '.xlsx';

        return Excel::download(
            new BookingsExport(
                $request->start_date,
                $request->end_date,
                $request->status
            ),
            $filename
        );
    }

    /**
     * Export bookings to PDF
     */
    public function exportPdf(Request $request)
    {
        if (!$this->checkAdmin()) abort(403);

        $query = Booking::with(['user', 'vehicle']);

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->get();
        $totalRevenue = $bookings->whereIn('status', ['confirmed', 'completed'])->sum('total_price');

        $pdf = Pdf::loadView('admin.reports.bookings-pdf', compact('bookings', 'totalRevenue'));

        return $pdf->download('bookings_report_' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Get advanced analytics data
     */
    public function analytics()
    {
        if (!$this->checkAdmin()) abort(403);

        // Revenue by vehicle type
        $revenueByType = Booking::whereIn('status', ['confirmed', 'completed'])
            ->join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
            ->selectRaw('vehicles.type, SUM(bookings.total_price) as revenue')
            ->groupBy('vehicles.type')
            ->get();

        // Booking trends (last 30 days)
        $bookingTrends = [];
        $trendLabels = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = Booking::whereDate('created_at', $date)->count();
            $bookingTrends[] = $count;
            $trendLabels[] = $date->format('M d');
        }

        // Top vehicles by bookings
        $topVehicles = Booking::select('vehicle_id')
            ->groupBy('vehicle_id')
            ->selectRaw('count(*) as booking_count')
            ->orderByDesc('booking_count')
            ->with('vehicle')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->vehicle->name,
                    'count' => $item->booking_count
                ];
            });

        // Customer segments
        $newCustomers = User::where('created_at', '>=', now()->subDays(30))->count();
        $returningCustomers = Booking::select('user_id')
            ->groupBy('user_id')
            ->havingRaw('count(*) > 1')
            ->count();

        return response()->json([
            'revenueByType' => $revenueByType,
            'bookingTrends' => $bookingTrends,
            'trendLabels' => $trendLabels,
            'topVehicles' => $topVehicles,
            'newCustomers' => $newCustomers,
            'returningCustomers' => $returningCustomers,
        ]);
    }

    /**
     * Search bookings
     */
    public function searchBookings(Request $request)
    {
        if (!$this->checkAdmin()) abort(403);

        $query = Booking::with(['user', 'vehicle']);

        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            })->orWhereHas('vehicle', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $bookings = $query->latest()->paginate(10);

        return response()->json($bookings);
    }
}
