<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email','password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Błędne dane logowania.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showRegisterForm()
    {
        return view('admin.register-company');
    }

    public function registerCompany(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:companies,nip',
            'email' => 'required|email|unique:companies,email',
            'phone' => 'nullable|string|max:20',
        ]);

        // ID firmy (5 cyfr)
        $companyId = random_int(10000, 99999);

        // Hasło tymczasowe
        $plainPassword = Str::random(8);

        // Zapis firmy w DB
        $company = Company::create([
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'street' => $request->street,
            'nip' => $request->nip,
            'email' => $request->email,
            'phone' => $request->phone,
            'exchange_rate' => 0.5,
            'password' => Hash::make($plainPassword),
            'company_id' => $companyId,
        ]);

        // Po rejestracji pokaż dane
        return redirect()->route('admin.register')->with('success', "
            Firma została zarejestrowana! <br>
            <strong>ID firmy:</strong> {$companyId} <br>
            <strong>Hasło:</strong> {$plainPassword}
        ");
    }
}
