<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('template');
            $table->text('waiting')->nullable(); 
            $table->text('apologize')->nullable();
            $table->text('maintext')->nullable();
            $table->text('addquestion')->nullable();            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
