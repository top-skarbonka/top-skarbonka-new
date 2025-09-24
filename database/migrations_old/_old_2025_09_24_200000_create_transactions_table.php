<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('client_id');
            $table->unsignedBigInteger('company_id');
            $table->string('receipt_number');
            $table->decimal('amount', 10, 2);
            $table->decimal('points', 10, 2);
            $table->timestamps();

            // Klucz obcy do clients
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            // Klucz obcy do companies
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
