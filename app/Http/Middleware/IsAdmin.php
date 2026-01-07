<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; 

class IsAdmin
{
    
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập khu vực này.');
        }

        return $next($request);
    }
}