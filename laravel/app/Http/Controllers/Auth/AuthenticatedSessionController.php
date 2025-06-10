<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        switch (true) {
            case $user->hasRole('admin'):
                return redirect()->route('admin.dashboard');

            case $user->hasRole('manager'):
                return redirect()->route('manager.dashboard');

            case $user->hasRole('leader'):
                return redirect()->route('leader.dashboard');

            case $user->hasRole('student'):
                return redirect()->route('students.dashboard');

            default:
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'You do not have any authorized role.',
                ]);
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
