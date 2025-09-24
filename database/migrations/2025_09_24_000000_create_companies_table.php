<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_code', 5)->unique(); // login firmy
            $table->string('name'); // nazwa firmy
            $table->string('email')->nullable(); // email firmy
            $table->string('password'); // hasło (bcrypt)
            $table->decimal('points_rate', 5, 2)->default(0.5); // kurs punktów np. 0.5 pkt za 1 zł
            $table->boolean('is_active')->default(true); // czy aktywna firma
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
