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
        Schema::table('annualearnings', function (Blueprint $table) {
            $table->string('earnings_source')->after('month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annualearnings', function (Blueprint $table) {
            $table->dropColumn('earnings_source');
        });
    }
};
