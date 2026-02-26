<?php

namespace App\Http\Controllers;

use App\Models\SsoToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * SSO Controller for Thiuu Ecosystem
 * 
 * Handles cross-app authentication between:
 * - Thiuu CarRental (this app)
 * - KThiuu Hotel
 */
class SsoController extends Controller
{
    private const APP_NAME = 'car_rental';

    /**
     * Redirect to KThiuu Hotel with SSO token
     */
    public function redirectToHotel(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('message', 'Vui lòng đăng nhập để tiếp tục');
        }

        $user = Auth::user();

        // Check app permission
        if (!$user->hasAppAccess('hotel')) {
            return back()->with('error', 'Bạn không có quyền truy cập KThiuu Hotel');
        }

        // Generate SSO token
        $ssoToken = SsoToken::generateFor($user, self::APP_NAME, 'hotel');

        // Redirect to Hotel app with token
        $hotelUrl = config('services.ecosystem.hotel_url', env('KTHIUU_HOTEL_URL', 'http://localhost:8001'));

        return redirect()->away($hotelUrl . '/sso/callback?token=' . $ssoToken->token);
    }

    /**
     * Handle SSO callback from KThiuu Hotel
     */
    public function callback(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return redirect()->route('login')
                ->with('error', 'Token không hợp lệ');
        }

        // Find and validate token
        $ssoToken = SsoToken::findValid($token, self::APP_NAME);

        if (!$ssoToken) {
            return redirect()->route('login')
                ->with('error', 'Token đã hết hạn hoặc không hợp lệ');
        }

        // Mark token as used
        $ssoToken->markAsUsed();

        // Log in the user
        Auth::login($ssoToken->user, true);

        return redirect()->intended('/dashboard')
            ->with('success', 'Đăng nhập thành công từ Thiuu Ecosystem');
    }

    /**
     * Ecosystem portal page showing both services
     */
    public function portal()
    {
        return view('ecosystem.portal', [
            'carRentalUrl' => env('THIUU_CARRENTAL_URL', 'http://localhost:8000'),
            'hotelUrl' => env('KTHIUU_HOTEL_URL', 'http://localhost:8001'),
            'user' => Auth::user(),
        ]);
    }
}
