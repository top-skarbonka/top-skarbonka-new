<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    // ----------------- NOWE METODY -----------------

    public function showRegisterForm()
    {
        return view('admin.companies.create');
    }

    public function registerCompany(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city' => 'required|string|max:120',
            'street' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:companies,nip',
            'phone' => 'nullable|string|max:50',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|string|min:6',
            'exchange_rate' => 'required|numeric|min:0',
            'agreement_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'regulations_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // zapisywanie plików
        $agreementPath = null;
        if ($request->hasFile('agreement_file')) {
            $agreementPath = $request->file('agreement_file')->store('agreements', 'public');
        }

        $regulationsPath = null;
        if ($request->hasFile('regulations_file')) {
            $regulationsPath = $request->file('regulations_file')->store('regulations', 'public');
        }

        // generowanie unikalnego company_id (np. 5 znaków)
        $companyId = strtoupper(substr(uniqid(), -5));

        $company = new Company();
        $company->company_id = $companyId;
        $company->name = $validated['name'];
        $company->postal_code = $validated['postal_code'];
        $company->city = $validated['city'];
        $company->street = $validated['street'];
        $company->nip = $validated['nip'];
        $company->phone = $validated['phone'] ?? null;
        $company->email = $validated['email'];
        $company->password = Hash::make($validated['password']);
        $company->exchange_rate = $validated['exchange_rate'];
        $company->agreement_file = $agreementPath;
        $company->regulations_file = $regulationsPath;
        $company->save();

        return redirect()->route('admin.dashboard')->with('success', 'Firma została zarejestrowana.');
    }
}
