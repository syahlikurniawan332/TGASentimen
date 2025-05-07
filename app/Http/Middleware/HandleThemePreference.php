<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleThemePreference
{
    public function handle(Request $request, Closure $next)
    {
        // Check cookie first
        if ($request->hasCookie('dark_mode')) {
            $darkMode = $request->cookie('dark_mode') === '1';
        } 
        // Then check session
        elseif (session()->has('dark_mode')) {
            $darkMode = session('dark_mode');
        }
        // Finally check browser preference
        else {
            $darkMode = false;
        }

        // Share with all views
        view()->share('dark_mode', $darkMode);

        return $next($request);
    }
}