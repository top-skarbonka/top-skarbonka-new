<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Transaction;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'companies'    => Company::count(),
            'clients'      => Client::count(),
            'transactions' => Transaction::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
