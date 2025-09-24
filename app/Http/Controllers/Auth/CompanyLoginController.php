<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('company.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'company_code' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('company')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('company.dashboard'));
        }

        return back()->withErrors([
            'company_code' => 'Nieprawidłowy kod firmy lub hasło.',
        ])->onlyInput('company_code');
    }

    public function logout(Request $request)
    {
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('company.login.form');
    }
}
