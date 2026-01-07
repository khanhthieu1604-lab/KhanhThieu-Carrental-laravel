<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    public function showLogin()
    {
        return view('auth.login');
    }

    
    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        
        if (Auth::attempt($credentials)) {

            
            $request->session()->regenerate();

            return redirect()
                ->intended('/')
                ->with('success', 'Chào mừng bạn quay trở lại!');
        }

        
        return back()
            ->withErrors([
                'email' => 'Email hoặc mật khẩu không chính xác.',
            ])
            ->onlyInput('email');
    }

    
    public function showRegister()
    {
        return view('auth.register');
    }

    
    public function register(Request $request)
    {
        
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
        ]);

        
        Auth::login($user);

        return redirect('/')
            ->with('success', 'Đăng ký tài khoản thành công!');
    }

    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Đã đăng xuất thành công.');
    }

    
    public function apiLogin(Request $request)
    {
        
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        
        $user = User::where('email', $request->email)->first();

        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Email hoặc mật khẩu không chính xác.'
            ], 401);
        }

        
        $token = $user->createToken('auth_token')->plainTextToken;

        
        return response()->json([
            'status'       => 'success',
            'message'      => 'Đăng nhập API thành công',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role
            ]
        ], 200);
    }

    
    public function apiLogout(Request $request)
    {
        
        $request->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Đã hủy Token và đăng xuất thành công.'
        ], 200);
    }
}
