<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaster
{
   
public function handle(Request $request, Closure $next)
{
    if (auth()->check() && auth()->user()->role === 'master') {
        return $next($request);
    }

    return redirect('/')->with('error', 'Bạn không có quyền truy cập khu vực này.');
}
}
