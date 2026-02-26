<?php

use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VNPayController;
use App\Http\Controllers\Api\AvailabilityController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\SsoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('splash');
})->name('splash');

// SSO Routes - Thiuu Ecosystem
Route::prefix('sso')->name('sso.')->group(function () {
    Route::get('/callback', [SsoController::class, 'callback'])->name('callback');
    Route::get('/to-hotel', [SsoController::class, 'redirectToHotel'])->name('to-hotel')->middleware('auth');
    Route::get('/portal', [SsoController::class, 'portal'])->name('portal');
});

Route::get('lang/{locale}', [App\Http\Controllers\LanguageController::class, 'switch'])->name('lang.switch');

Route::get('/home', [VehicleController::class, 'home'])->name('home');

// Search Routes
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/api/search/autocomplete', [SearchController::class, 'autocomplete'])->name('api.search.autocomplete');
Route::get('/api/search/filters', [SearchController::class, 'filters'])->name('api.search.filters');

// AI Chat Routes
Route::post('/api/ai/chat', [AIChatController::class, 'chat'])->name('ai.chat');
Route::post('/api/ai/recommend', [AIChatController::class, 'recommend'])->name('ai.recommend');
Route::post('/api/ai/clear-history', [AIChatController::class, 'clearHistory'])->name('ai.clear');

Route::controller(VehicleController::class)->prefix('vehicles')->name('vehicles.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{id}', 'show')->name('show');
});

Route::view('/about', 'about')->name('about');
Route::view('/services', 'services')->name('services');

Route::prefix('pages')->name('pages.')->group(function () {
    Route::view('/vip-driver', 'pages.vip-driver')->name('vip-driver');
    Route::view('/blog', 'pages.blog')->name('blog');
    Route::view('/policy', 'pages.policy')->name('policy');
    Route::view('/procedures', 'pages.procedures')->name('procedures');
    Route::view('/faq', 'pages.faq')->name('faq');
    Route::view('/payment-methods', 'pages.payment-methods')->name('payment');
    Route::view('/partnership', 'pages.partnership')->name('partnership');
    Route::view('/terms', 'pages.terms')->name('terms');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return in_array(auth()->user()->role, ['admin', 'master'])
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    })->name('dashboard');

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    Route::controller(BookingController::class)->prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/create/{vehicle_id}', 'create')->name('create');
        Route::post('/store', 'store')->name('store')->middleware('throttle.booking');
        Route::get('/history', 'history')->name('history');
        Route::get('/contract/{id}', 'showContract')->name('contract');
        Route::get('/{id}', 'show')->name('show');
    });

    Route::get('/payment/create/{booking}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/{booking}/confirm', [PaymentController::class, 'confirm'])
        ->name('payment.confirm')
        ->middleware('throttle.payment');

    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store')
        ->middleware('throttle.review');

    // Notification Routes
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('read');
        Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('read-all');
        Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
    });

    // VNPay Payment Routes
    Route::get('/payment/vnpay/return', [VNPayController::class, 'return'])->name('vnpay.return');
    Route::post('/payment/vnpay/ipn', [VNPayController::class, 'ipn'])->name('vnpay.ipn');

    // API Routes - Availability Calendar
    Route::prefix('api/vehicles/{vehicle}')->group(function () {
        Route::get('/availability/booked-dates', [AvailabilityController::class, 'bookedDates'])->name('api.vehicles.booked-dates');
        Route::post('/availability/check', [AvailabilityController::class, 'check'])->name('api.vehicles.check-availability');
    });

    // Admin Routes
    Route::middleware(['role:admin,master'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/stats', [AdminController::class, 'stats'])->name('dashboard.stats');
        Route::post('/about/update', [AdminController::class, 'updateAbout'])->name('about.update');

        // Export & Analytics
        Route::get('/export/excel', [AdminController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [AdminController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
        Route::get('/search/bookings', [AdminController::class, 'searchBookings'])->name('search.bookings');

        Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', [BookingController::class, 'history'])->name('index');
            Route::get('/{id}', [BookingController::class, 'show'])->name('show');
            Route::patch('/{id}', [AdminController::class, 'updateStatus'])->name('update');
        });

        Route::controller(AdminController::class)->prefix('users')->name('users.')->group(function () {
            Route::get('/', 'usersIndex')->name('users.index');
            Route::put('/{id}/role', 'updateUserRole')->name('role');
            Route::delete('/{id}', 'deleteUser')->name('destroy');
        });

        Route::resource('vehicles', VehicleController::class)->except(['index', 'show']);
        Route::get('/vehicles-list', [VehicleController::class, 'adminIndex'])->name('vehicles.index');

        Route::prefix('vehicles/{id}')->name('vehicles.')->group(function () {
            Route::get('/manage', [VehicleController::class, 'manage'])->name('manage');
            Route::patch('/maintenance', [VehicleController::class, 'updateMaintenance'])->name('maintenance');
        });

        Route::post('/maintenance/store', [MaintenanceController::class, 'store'])->name('maintenance.store');
        Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');
    });
});

// Development Routes (Local only)
if (app()->isLocal()) {
    Route::get('/tao-xe-nhanh', [VehicleController::class, 'autoGenerate']);
    Route::get('/cuu-toi-di', function () {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        try {
            Artisan::call('migrate:fresh --seed --force');
            Artisan::call('storage:link');
            return "<div style='font-family:sans-serif; text-align:center; padding:50px;'>
                        <h2 style='color:#10b981'>✅ HỆ THỐNG ĐÃ ĐƯỢC LÀM SẠCH!</h2>
                        <p>Database đã được reset và nạp dữ liệu mẫu siêu xe.</p>
                        <hr style='border:0; border-top:1px solid #eee; margin:20px 0;'>
                        <a href='/home' style='background:#eab308; color:#000; padding:10px 20px; text-decoration:none; border-radius:5px; font-weight:bold;'>QUAY LẠI TRANG CHỦ</a>
                    </div>";
        } catch (\Exception $e) {
            return "<h2 style='color:#ef4444'>❌ Lỗi: " . $e->getMessage() . "</h2>";
        }
    });
}

require __DIR__ . '/auth.php';
