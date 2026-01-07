<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\VehicleApiController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::post('/login', [AuthApiController::class, 'login']); 
Route::get('/vehicles', [VehicleApiController::class, 'index']); 
Route::get('/vehicles/{id}', [VehicleApiController::class, 'show']); 


Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/profile', function (Request $request) { 
        return $request->user(); 
    });
    Route::put('/profile/update', [ProfileController::class, 'apiUpdate']);
    Route::post('/logout', [AuthApiController::class, 'logout']); 

    
    Route::post('/bookings/store', [BookingController::class, 'apiStore']);
    Route::get('/bookings/my-history', [BookingController::class, 'apiHistory']);

    
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/stats', [DashboardController::class, 'apiStats']);
        Route::get('/bookings', [BookingController::class, 'apiAllBookings']);
        Route::patch('/bookings/{id}/status', [BookingController::class, 'apiUpdateStatus']);
        Route::post('/vehicles', [VehicleApiController::class, 'apiStore']); 
    });
});