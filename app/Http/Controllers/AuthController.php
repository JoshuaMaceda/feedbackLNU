<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        $request->session()->invalidate(); // ✅ Clears expired sessions when login page is accessed
        $request->session()->regenerateToken(); // ✅ Generates a new CSRF token

        return view('auth.login'); // 🚨 Ensure this view exists!
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // ✅ Redirect properly
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // ✅ Clears session data
        $request->session()->regenerateToken(); // ✅ Prevents CSRF errors

        return redirect('/'); // ✅ Redirects user to login page
    }

}
