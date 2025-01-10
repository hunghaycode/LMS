<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
             // if (Auth::guard($guard)->check()) {
            
        //     if (Auth::check() && Auth::user()->role == 'user') {
        //         return redirect('/dashboard');
        //     }if (Auth::check() && Auth::user()->role == 'instructor') {
        //         return redirect('/instructor/dashboard');
        //     }if (Auth::check() && Auth::user()->role == 'admin') {
        //         return redirect('/admin/dashboard');
        //     }  

        // }
    }
}
