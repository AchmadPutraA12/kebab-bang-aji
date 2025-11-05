<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user || $user->category_id != $role) {
            return redirect('/login')->withErrors(['access' => 'Anda tidak memiliki akses ke halaman ini.']);
        }

        return $next($request);
    }
}


