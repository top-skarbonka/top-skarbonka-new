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
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%");
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
        $validated = $request->validate([
            'name'         => ['required','string','max:255'],
            'postal_code'  => ['required','string','max:20'],
            'city'         => ['required','string','max:255'],
            'nip'          => ['required','string','max:20','unique:companies,nip'],
            'phone'        => ['nullable','string','max:30'],
            'email'        => ['required','email','max:255','unique:companies,email'],
            'points_rate'  => ['required','numeric','min:0.01'],
            'agreement_file' => ['nullable','file','mimes:jpg,jpeg,png,pdf','max:5120'],
            'rules_file'     => ['nullable','file','mimes:jpg,jpeg,png,pdf','max:5120'],
        ]);

        // Wygeneruj unikalny kod firmy (5 znaków)
        do {
            $companyCode = strtoupper(Str::random(5));
        } while (Company::where('company_code', $companyCode)->exists());

        // Wygeneruj hasło
        $plainPassword = Str::random(10);

        $company = new Company();
        $company->company_code = $companyCode;
        $company->name = $validated['name'];
        $company->postal_code = $validated['postal_code'];
        $company->city = $validated['city'];
        $company->nip = $validated['nip'];
        $company->phone = $validated['phone'] ?? null;
        $company->email = $validated['email'];
        $company->points_rate = $validated['points_rate'];
        $company->password = Hash::make($plainPassword);
        $company->is_active = true;

        // Zapis plików
        if ($request->hasFile('agreement_file')) {
            $company->agreement_file = $request->file('agreement_file')->store('agreements','public');
        }
        if ($request->hasFile('rules_file')) {
            $company->rules_file = $request->file('rules_file')->store('rules','public');
        }

        $company->save();

        return redirect()->route('admin.companies.index')
            ->with('success', "Firma została dodana. Hasło: <b>{$plainPassword}</b>");
    }

    /**
     * Formularz edycji firmy
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Aktualizacja firmy
     */
    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name'         => ['required','string','max:255'],
            'postal_code'  => ['required','string','max:20'],
            'city'         => ['required','string','max:255'],
            'nip'          => ['required','string','max:20','unique:companies,nip,'.$company->id],
            'phone'        => ['nullable','string','max:30'],
            'email'        => ['required','email','max:255','unique:companies,email,'.$company->id],
            'points_rate'  => ['required','numeric','min:0.01'],
            'agreement_file' => ['nullable','file','mimes:jpg,jpeg,png,pdf','max:5120'],
            'rules_file'     => ['nullable','file','mimes:jpg,jpeg,png,pdf','max:5120'],
        ]);

        $company->update($validated);

        // Zapis plików
        if ($request->hasFile('agreement_file')) {
            $company->agreement_file = $request->file('agreement_file')->store('agreements','public');
        }
        if ($request->hasFile('rules_file')) {
            $company->rules_file = $request->file('rules_file')->store('rules','public');
        }

        $company->save();

        return redirect()->route('admin.companies.index')->with('success','Dane firmy zaktualizowane.');
    }

    /**
     * Reset hasła
     */
    public function resetPassword(Company $company)
    {
        $plainPassword = Str::random(10);
        $company->password = Hash::make($plainPassword);
        $company->save();

        return back()->with('success', "Hasło dla firmy {$company->name} zostało zresetowane. Nowe hasło: <b>{$plainPassword}</b>");
    }

    /**
     * Zawieszenie / aktywacja firmy
     */
    public function toggleActive(Company $company)
    {
        $company->is_active = !$company->is_active;
        $company->save();

        return back()->with('success', "Status firmy {$company->name} został zmieniony.");
    }

    /**
     * Usuwanie firmy
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return back()->with('success',"Firma została usunięta.");
    }
}
