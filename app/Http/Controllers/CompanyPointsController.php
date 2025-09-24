<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\TopPointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CompanyPointsController extends Controller
{
    public function create(Request $request)
    {
        // Można przekazać client_id w URL (np. z QR), ale tutaj ręcznie
        return view('company.points.create');
    }

    public function store(Request $request)
    {
        $company = Auth::guard('company')->user();

        $validated = $request->validate([
            'client_id' => ['required', 'uuid', 'exists:clients,id'],
            'receipt_number' => [
                'required', 'string', 'max:64',
                Rule::unique('top_point_transactions')->where(function ($q) use ($company) {
                    return $q->where('company_id', $company->id);
                }),
            ],
            'amount_pln' => ['required', 'numeric', 'min:0.01', 'max:1000000'],
        ]);

        $points = round($validated['amount_pln'] * (float)$company->points_rate, 2);

        // Zapis transakcji
        TopPointTransaction::create([
            'client_id'      => $validated['client_id'],
            'company_id'     => $company->id,
            'receipt_number' => $validated['receipt_number'],
            'amount_pln'     => $validated['amount_pln'],
            'points'         => $points,
        ]);

        // Aktualizacja salda klienta
        $client = Client::findOrFail($validated['client_id']);
        $client->points_balance = round(((float)$client->points_balance + $points), 2);
        $client->save();

        return redirect()->route('company.points.create')
            ->with('success', 'Dodano punkty: '.$points.' (kurs: '.$company->points_rate.' pkt / 1 zł)');
    }
}
