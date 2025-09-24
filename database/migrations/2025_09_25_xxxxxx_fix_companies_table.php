<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // company_id -> company_code
            if (Schema::hasColumn('companies', 'company_id') && !Schema::hasColumn('companies', 'company_code')) {
                $table->renameColumn('company_id', 'company_code');
            }

            // points_rate
            if (!Schema::hasColumn('companies', 'points_rate')) {
                $table->decimal('points_rate', 5, 2)->default(0.5)->after('email');
            }

            // is_active
            if (!Schema::hasColumn('companies', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('password');
            }

            // street i inne pola jako opcjonalne
            if (Schema::hasColumn('companies', 'street')) {
                $table->string('street')->nullable()->change();
            }
            if (Schema::hasColumn('companies', 'postal_code')) {
                $table->string('postal_code')->nullable()->change();
            }
            if (Schema::hasColumn('companies', 'city')) {
                $table->string('city')->nullable()->change();
            }
            if (Schema::hasColumn('companies', 'nip')) {
                $table->string('nip')->nullable()->change();
            }
            if (Schema::hasColumn('companies', 'phone')) {
                $table->string('phone')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Cofanie zmian
            if (Schema::hasColumn('companies', 'company_code')) {
                $table->renameColumn('company_code', 'company_id');
            }

            if (Schema::hasColumn('companies', 'points_rate')) {
                $table->dropColumn('points_rate');
            }

            if (Schema::hasColumn('companies', 'is_active')) {
                $table->dropColumn('is_active');
            }

            if (Schema::hasColumn('companies', 'street')) {
                $table->string('street')->nullable(false)->change();
            }
            if (Schema::hasColumn('companies', 'postal_code')) {
                $table->string('postal_code')->nullable(false)->change();
            }
            if (Schema::hasColumn('companies', 'city')) {
                $table->string('city')->nullable(false)->change();
            }
            if (Schema::hasColumn('companies', 'nip')) {
                $table->string('nip')->nullable(false)->change();
            }
            if (Schema::hasColumn('companies', 'phone')) {
                $table->string('phone')->nullable(false)->change();
            }
        });
    }
};
