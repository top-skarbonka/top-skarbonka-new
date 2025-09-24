<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // nazwa admina
            $table->string('email')->unique();    // email (unikalny)
            $table->string('password');           // hasło (hashowane)
            $table->timestamps();                 // created_at i updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
