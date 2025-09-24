<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
$table->string('company_id', 5)->unique()->nullable();            $table->string('name');                  // nazwa firmy
            $table->string('postal_code');           // kod pocztowy
            $table->string('city');                  // miasto
            $table->string('street');                // ulica i nr
            $table->string('nip')->unique();         // NIP (unikalny)
            $table->string('email')->unique();       // email (unikalny, login)
            $table->string('phone')->nullable();     // telefon (opcjonalnie)
            $table->decimal('exchange_rate', 5, 2)->default(0.5); // przelicznik punktów
            $table->string('password');              // hasło firmy
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
