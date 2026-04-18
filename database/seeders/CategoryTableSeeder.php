<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        // DB::table('categories')->delete();

        DB::table('categories')->insert([
            [
                'id' => '1',
                'name' => 'Waiting sentences',
                'slug' => 'waiting-sentences',
                'priority' => '1',
                'beforemaintext' => true,
            ], 
            [
                'id' => '2',
                'name' => 'Apologize sentences',
                'slug' => 'apologize-sentences',
                'priority' => '2',
                'beforemaintext' => true,
            ], 
            [
                'id' => '3',
                'name' => 'Additional questions',
                'slug' => 'additional-questions',
                'priority' => '1',
                'beforemaintext' => false,
            ],          
            [
                'id' => '4',
                'name' => 'Goodbye sentences',
                'slug' => 'goodbye-sentences',
                'priority' => '2',
                'beforemaintext' => false,
            ],
        ]);
    }
}
