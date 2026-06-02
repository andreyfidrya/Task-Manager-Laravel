<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('answers')->truncate(); 

        DB::table('answers')->insert([
            'template' => 'Answer Template',
            'waiting' => 'Waiting sentence',
            'apologize' => 'Apologies',
            'maintext' => 'Main Text',
            'addquestion' => 'Additional question',
            'goodbye' => 'Goodbye sentence'
        ]);
    }
}
