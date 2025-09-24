<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Zmień company_id → company_code jeśli jeszcze istnieje
            if (Schema::hasColumn('companies', 'company_id') && !Schema::hasColumn('companies', 'company_code')) {
                $table->renameColumn('company_id', 'company_code');
            }

            // Dodaj company_code jeśli nadal brak
            if (!Schema::hasColumn('companies', 'company_code')) {
                $table->string('company_code', 10)->unique()->after('id');
            }

            // Dodaj points_rate jeśli brak
            if (!Schema::hasColumn('companies', 'points_rate')) {
                $table->decimal('points_rate', 5, 2)->default(0.5)->after('email');
            }

            // Dodaj is_active jeśli brak
            if (!Schema::hasColumn('companies', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('password');
            }

            // Dodaj agreement_file jeśli brak
            if (!Schema::hasColumn('companies', 'agreement_file')) {
                $table->string('agreement_file')->nullable()->after('is_active');
            }

            // Dodaj regulations_file jeśli brak
            if (!Schema::hasColumn('companies', 'regulations_file')) {
                $table->string('regulations_file')->nullable()->after('agreement_file');
            }
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            if (Schema::hasColumn('companies', 'agreement_file')) {
                $table->dropColumn('agreement_file');
            }
            if (Schema::hasColumn('companies', 'regulations_file')) {
                $table->dropColumn('regulations_file');
            }
            if (Schema::hasColumn('companies', 'points_rate')) {
                $table->dropColumn('points_rate');
            }
            if (Schema::hasColumn('companies', 'is_active')) {
                $table->dropColumn('is_active');
            }
            if (Schema::hasColumn('companies', 'company_code')) {
                $table->dropColumn('company_code');
            }
        });
    }
};
