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
            $table->float('andrey')->after('month')->nullable;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annualearnings', function (Blueprint $table) {
            $table->dropColumn('andrey');
        });
    }
};
