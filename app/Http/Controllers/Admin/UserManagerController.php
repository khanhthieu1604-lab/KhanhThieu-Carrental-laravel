<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagerController extends Controller
{
    
    public function index()
    {
        
        $users = User::select('id', 'name', 'email', 'role', 'phone', 'created_at')
            ->where('id', '!=', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        
        return view('admin.users.index', compact('users'));
    }

    
    public function toggleRole($id)
    {
        
        $user = User::findOrFail($id);

        
        if ($user->role === 'master') {
            return back()->with(
                'error',
                'Không thể thay đổi quyền hạn của tài khoản Master.'
            );
        }

        
        $user->role = ($user->role === 'admin') ? 'user' : 'admin';
        $user->save();

        
        return back()->with(
            'success',
            'Đã cập nhật quyền hạn cho ' . $user->name
        );
    }

    
    public function destroy($id)
    {
        
        $currentUser = auth()->user();

        
        $targetUser = User::findOrFail($id);

        
        if ($targetUser->role === 'master') {
            return back()->with(
                'error',
                'Không thể xóa tài khoản hệ thống (Master).'
            );
        }

        
        if (
            $currentUser->role !== 'master'
            && $targetUser->role === 'admin'
        ) {
            return back()->with(
                'error',
                'Bạn không đủ quyền để xóa một Quản trị viên khác.'
            );
        }

        
        $targetUser->delete();

        
        return back()->with(
            'success',
            'Đã xóa tài khoản thành công.'
        );
    }
}
