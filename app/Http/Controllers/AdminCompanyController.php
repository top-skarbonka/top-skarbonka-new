<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminCompanyController extends Controller
{
    /**
     * Lista firm + wyszukiwarka
     */
    public function index(Request $request)
    {
        $query = Company::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('id', $search)
                  ->orWhere('phone', 'LIKE', "%{$search}%");
        }

        $companies = $query->latest()->paginate(15);

        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Formularz dodawania firmy
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Zapis nowej firmy
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city'        => 'required|string|max:255',
            'nip'         => 'required|string|max:20|unique:companies',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'required|email|unique:companies',
            'password'    => 'required|string|min:6|confirmed',
            'points_rate' => 'required|numeric|min:0.01',
            'agreement_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'rules_file'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $company = new Company($request->except(['password','agreement_file','rules_file']));
        $company->password = Hash::make($request->password);
        $company->company_code = strtoupper(Str::random(5));

        if ($request->hasFile('agreement_file')) {
            $company->agreement_file = $request->file('agreement_file')->store('agreements', 'public');
        }

        if ($request->hasFile('rules_file')) {
            $company->rules_file = $request->file('rules_file')->store('rules', 'public');
        }

        $company->save();

        return redirect()->route('admin.companies.index')->with('success', 'Firma została dodana.');
    }

    /**
     * Szczegóły firmy
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Formularz edycji
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Zapis edycji
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city'        => 'required|string|max:255',
            'nip'         => 'required|string|max:20|unique:companies,nip,'.$company->id,
            'phone'       => 'nullable|string|max:20',
            'email'       => 'required|email|unique:companies,email,'.$company->id,
            'points_rate' => 'required|numeric|min:0.01',
            'agreement_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'rules_file'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $company->fill($request->except(['agreement_file','rules_file']));

        if ($request->hasFile('agreement_file')) {
            $company->agreement_file = $request->file('agreement_file')->store('agreements', 'public');
        }

        if ($request->hasFile('rules_file')) {
            $company->rules_file = $request->file('rules_file')->store('rules', 'public');
        }

        $company->save();

        return redirect()->route('admin.companies.index')->with('success', 'Firma została zaktualizowana.');
    }

    /**
     * Reset hasła
     */
    public function resetPassword($id)
    {
        $company = Company::findOrFail($id);
        $newPassword = Str::random(8);
        $company->password = Hash::make($newPassword);
        $company->save();

        return redirect()->route('admin.companies.index')->with('success', "Hasło firmy zostało zresetowane. Nowe hasło: {$newPassword}");
    }

    /**
     * Aktywacja / zawieszenie firmy
     */
    public function toggleStatus($id)
    {
        $company = Company::findOrFail($id);
        $company->is_active = !$company->is_active;
        $company->save();

        return redirect()->route('admin.companies.index')->with('success', 'Status firmy został zmieniony.');
    }

    /**
     * Usuwanie firmy
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('admin.companies.index')->with('success', 'Firma została usunięta.');
    }
}
