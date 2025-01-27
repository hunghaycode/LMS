<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('frontend.auth.user-login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $url = '';

        if ($request->user()->role == 'user') {
            $url ='/dashboard';
        }elseif ($request->user()->role == 'instructor') {
            $url = '/dashboard';
        }elseif ($request->user()->role == 'admin') {
            $url = '/admin/dashboard';
        }  


    return redirect()->intended($url);
    }
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();
    //     $url = '';

    //     if ($request->user()->role == 'user') {
    //         $url = '/dashboard';
    //     } elseif ($request->user()->role == 'instructor') {
    //         $url = '/dashboard';
    //     } elseif ($request->user()->role == 'admin') {
    //         $url = '/admin/dashboard';
    //     }

    //     $notification = array(
    //         'message' => 'Login Successfully',
    //         'alert-type' => 'success'
    //     );


    //     return redirect()->intended($url)->with($notification);
    // }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
