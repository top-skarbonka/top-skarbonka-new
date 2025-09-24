<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // company_id → company_code
            if (Schema::hasColumn('companies', 'company_id') && !Schema::hasColumn('companies', 'company_code')) {
                $table->renameColumn('company_id', 'company_code');
            }

            // Dodaj company_code jeśli nadal brak
            if (!Schema::hasColumn('companies', 'company_code')) {
                $table->string('company_code', 10)->unique()->nullable()->after('id');
            }

            // Pola opcjonalne
            if (Schema::hasColumn('companies', 'name')) {
                $table->string('name')->nullable()->change();
            }
            if (Schema::hasColumn('companies', 'postal_code')) {
                $table->string('postal_code')->nullable()->change();
            }
            if (Schema::hasColumn('companies', 'city')) {
                $table->string('city')->nullable()->change();
            }
            if (Schema::hasColumn('companies', 'street')) {
                $table->string('street')->nullable()->change();
            }
            if (Schema::hasColumn('companies', 'nip')) {
                $table->string('nip')->nullable()->change();
            }
            if (Schema::hasColumn('companies', 'phone')) {
                $table->string('phone')->nullable()->change();
            }

            // Wymagane: points_rate
            if (!Schema::hasColumn('companies', 'points_rate')) {
                $table->decimal('points_rate', 5, 2)->default(0.5)->after('email');
            }

            // Opcjonalne: aktywność i pliki
            if (!Schema::hasColumn('companies', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('password');
            }
            if (!Schema::hasColumn('companies', 'agreement_file')) {
                $table->string('agreement_file')->nullable()->after('is_active');
            }
            if (!Schema::hasColumn('companies', 'regulations_file')) {
                $table->string('regulations_file')->nullable()->after('agreement_file');
            }
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Nic nie usuwamy żeby nie rozwalić danych
        });
    }
};
