<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('locale')) {
            \Log::info('Localization Middleware: Setting locale to ' . Session::get('locale'));
            App::setLocale(Session::get('locale'));
        } else {
            \Log::info('Localization Middleware: No locale in session, using default ' . App::getLocale());
        }
        return $next($request);
    }
}
