<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('agreement_file')->nullable()->after('password');     // skan podpisanej umowy
            $table->string('regulations_file')->nullable()->after('agreement_file'); // skan regulaminu
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['agreement_file', 'regulations_file']);
        });
    }
};
