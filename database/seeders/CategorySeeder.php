<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Waiting sentences',
                'slug' => 'waiting-sentences',
                'beforemaintext' => true,
            ], 
            [
                'name' => 'Apologize sentences',
                'slug' => 'apologize-sentences',
                'beforemaintext' => true,
            ], 
            [
                'name' => 'Additional questions',
                'slug' => 'additional-sentences',
                'beforemaintext' => false,
            ],          
            [
                'name' => 'Goodbye sentences',
                'slug' => 'goodbye-sentences',
                'beforemaintext' => false,
            ],
        ]);
    }
}
