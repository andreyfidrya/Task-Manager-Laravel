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
            'template' => 'Template 1',
            'waiting' => 'Waiting sentence',
            'apologize' => 'Apologies',
            'addquestion' => 'Additional question',
            'goodbye' => 'Goodbye sentence'
        ]);
    }
}
