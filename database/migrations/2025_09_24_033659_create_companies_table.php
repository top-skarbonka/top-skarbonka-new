<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');                // Nazwa firmy
            $table->string('postal_code');         // Kod pocztowy
            $table->string('city');                // Miasto
            $table->string('nip')->unique();       // NIP
            $table->string('phone')->nullable();   // Telefon
            $table->string('email')->unique();     // Email (login)
            $table->string('password');            // Hasło
            $table->decimal('points_rate', 5, 2)->default(0.5); // Przelicznik pkt/PLN
            $table->string('agreement')->nullable();   // Umowa (ścieżka do pliku)
            $table->string('regulations')->nullable(); // Regulamin (ścieżka do pliku)
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
