<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Display login form
    public function login(): View
    {
        return view(
            'auth.login',
            [
                'title' => 'Log in'
            ]
        );
    }

    // Authenticate user
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirect to authors (you can change this later)
            return redirect('/authors');
        }

        return back()->withErrors([
            'name' => 'Failed to authenticate',
        ]);
    }

    // End user session (Logout)
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
