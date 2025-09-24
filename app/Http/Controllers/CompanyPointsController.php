<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Company;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class CompanyPointsController extends Controller
{
    // Formularz dodawania punktów
    public function create(Request $request)
    {
        $clientId = $request->get('client_id'); // ID klienta z QR
        return view('company.points.create', compact('clientId'));
    }

    // Zapis punktów
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|string',
            'receipt_number' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
        ]);

        // Szukamy klienta po jego client_code
        $client = Client::where('client_code', $validated['client_id'])->firstOrFail();

        // Kurs przypisany firmie
        $company = Auth::guard('company')->user();
        $points = $validated['amount'] * $company->points_rate;

        // Aktualizacja salda klienta
        $client->points_balance += $points;
        $client->save();

        // Zapis transakcji
        Transaction::create([
            'client_id' => $client->id,
            'company_id' => $company->id,
            'receipt_number' => $validated['receipt_number'],
            'amount' => $validated['amount'],
            'points' => $points,
        ]);

        return redirect()->route('company.dashboard')->with('success', 'Punkty zostały przyznane!');
    }
}
