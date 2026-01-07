<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    
    public function login(Request $request)
    {
        
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        
        $user = User::where('email', $request->email)->first();

        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Thông tin đăng nhập không chính xác'
            ], 401);
        }

        
        $token = $user->createToken('auth_token')->plainTextToken;

        
        return response()->json([
            'status'       => 'success',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role
            ]
        ]);
    }

    
    public function logout(Request $request)
    {
        
        $request->user()
            ->currentAccessToken()
            ->delete();

        
        return response()->json([
            'status'  => 'success',
            'message' => 'Đã đăng xuất và hủy token thành công'
        ]);
    }
}
