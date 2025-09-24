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
            $table->string('name');                  // nazwa firmy
            $table->string('postal_code');           // kod pocztowy
            $table->string('city');                  // miasto
            $table->string('street');                // ulica i nr
            $table->string('nip')->unique();         // NIP (unikalny)
            $table->string('email')->unique();       // e-mail (unikalny)
            $table->string('phone')->nullable();     // telefon
            $table->decimal('exchange_rate', 5, 2);  // przelicznik np. 0.50
            $table->string('password');              // hasło (hash)
            $table->rememberToken();                 // remember_token dla guardu
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
