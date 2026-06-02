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
            $table->text('waiting');  
            $table->text('apologize');
            $table->text('maintext');
            $table->text('addquestion');
            $table->text('goodbye');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
