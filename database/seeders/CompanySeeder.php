<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::updateOrCreate(
            ['email' => 'firma@test.pl'],
            [
                'name'          => 'Firma Testowa',
                'postal_code'   => '00-000',
                'city'          => 'Warszawa',
                'street'        => 'Testowa 123',
                'nip'           => '1234567890',
                'phone'         => '123456789',
                'exchange_rate' => 0.50,
                'password'      => Hash::make('haslo12345'),
            ]
        );
    }
}
