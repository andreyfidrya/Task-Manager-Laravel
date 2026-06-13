<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerTableSeeder extends Seeder
{
    public function run(): void
    {
        // DB::table('answers')->truncate(); 

        DB::table('answers')->insert([
            'template' => 'Answer Template 1',
            'waiting' => 'Thank you for the long waiting!',
            'apologize' => null,
            'maintext' => null,
            'addquestion' => 'Are there any other questions I can help you with?'            
        ]);
    }
}
