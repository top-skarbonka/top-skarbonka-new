<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ClientRegisterController extends Controller
{
    public function showForm()
    {
        return view('client.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required','email','unique:clients,email'],
            'postal_code' => ['required','string','max:12'],
            'city' => ['required','string','max:120'],
            'phone' => ['nullable','string','max:32'],
        ]);

        // Prostsze ID: 5 losowych cyfr + 2 pierwsze litery emaila
        $digits = rand(10000, 99999);
        $letters = substr(strtolower($validated['email']), 0, 2);
        $clientCode = $digits.$letters;

        $client = new Client();
        $client->id = (string) Str::uuid();
        $client->client_code = $clientCode;
        $client->email = $validated['email'];
        $client->postal_code = $validated['postal_code'];
        $client->city = $validated['city'];
        $client->phone = $validated['phone'] ?? null;
        $client->points_balance = $validated['phone'] ? 100 : 0; // bonus 100 pkt za telefon
        $client->save();

        // Generujemy QR z linkiem do panelu firmy z ID klienta
        $qr = QrCode::size(250)->generate(
            url('/company/points/new?client_id='.$client->client_code)
        );

        return view('client.qr', [
            'client' => $client,
            'qr' => $qr
        ]);
    }
}
