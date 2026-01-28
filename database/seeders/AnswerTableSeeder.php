<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('answers')->insert([
            'template' => 'Template 1',
            'waiting' => 'Please, wait a few minutes in the chat',
            'apologize' => 'We apologize for inconvenience',
            'addquestion' => 'Is anything else I can help you with?',
            'goodbye' => 'If you have any other questions, please contact us anytime'
        ]);
    }
}
