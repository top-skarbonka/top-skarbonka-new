<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'company_id'   => str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT), // losowe 5 cyfr
            'name'         => 'Firma Testowa',
            'email'        => 'firma@test.pl',
            'postal_code'  => '00-000',
            'city'         => 'Warszawa',
            'street'       => 'Testowa 123',
            'nip'          => '1234567890',
            'phone'        => '123456789',
            'exchange_rate'=> 0.5,
            'password'     => Hash::make('haslo123'),
        ]);
    }
}
