<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SentenceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sentences')->insert([
            [
                'name' => 'Please, wait a few minutes. I need to check the information on your request.',
                'category_id' => '9',                
            ], 
            [
                'name' => 'We apologize for inconvenience',
                'category_id' => '10',                
            ], 
            [
                'name' => 'Is anything else I can help you with?',
                'category_id' => '11',                
            ],          
            [
                'name' => 'If you have any other questions, please contact us',
                'category_id' => '12',                
            ],
        ]);
    }
}
