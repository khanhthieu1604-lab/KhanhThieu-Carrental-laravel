<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        \Log::info('LanguageController: Switch requested to ' . $locale);
        if (in_array($locale, ['en', 'vi'])) {
            Session::put('locale', $locale);
            \Log::info('LanguageController: Swithced session locale to ' . $locale);
        }
        return redirect()->back();
    }
}
