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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('postal_code')->after('name');
            $table->string('city')->after('postal_code');
            $table->string('nip')->unique()->after('city');
            $table->string('phone')->nullable()->after('nip');
            $table->decimal('points_rate', 5, 2)->default(0.5)->after('password');
            $table->string('agreement')->nullable()->after('points_rate');
            $table->string('regulations')->nullable()->after('agreement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['postal_code','city','nip','phone','points_rate','agreement','regulations']);
        });
    }
};
