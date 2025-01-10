<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::user()->role ?? null; // Lấy role của người dùng

                // Redirect theo role
                switch ($role) {
                    case 'user':
                        return redirect('/dashboard');
                    case 'instructor':
                        return redirect('/dashboard');
                    case 'admin':
                        return redirect('/admin/dashboard');
                }
            }
        }

        return $next($request);
    }
}


