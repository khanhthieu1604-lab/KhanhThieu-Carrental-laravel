<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminManagerController extends Controller
{
    
    public function index()
    {
        
        $admins = User::where('role', 'admin')->get();

        
        $users = User::where('role', 'user')->get();

        return view(
            'master.admins.index',
            compact('admins', 'users')
        );
    }

    
    public function store(Request $request)
    {
        
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        
        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'role'              => 'admin',
            'email_verified_at' => now(),
        ]);

        
        return back()->with(
            'success',
            'Đã tạo tài khoản Admin thành công!'
        );
    }

    
    public function promote($id)
    {
        
        $user = User::findOrFail($id);

        
        $user->role = 'admin';
        $user->save();

        
        return back()->with(
            'success',
            'Đã nâng cấp tài khoản lên Admin!'
        );
    }
}
