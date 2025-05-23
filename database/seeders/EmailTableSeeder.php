<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('emails')->insert([
            'template' => 'Template 1',
            'spam' => '',
            'client' => 'Hello,',
            'intro' => 'I have 10 years of experience in content writing and I have a passion for what I do. I have written articles and website content on different topics. Some of my website content writing projects are listed in the portfolio. So, you can see the quality of my work.
            <p>I always write content for clients on my own and never outsource work to other content creators!',
            'wordpress' => '',
            'seo' => '',
            'cost' => 'My writing speed is 500 words of original content (research + writing) per 1 billable hour.',
            'conclusion' => '<p>I am committed to the best possible customer experience and achieving 100% customer satisfaction! That’s why I do every single thing possible to make each of my customers happy!
            
            <p>Thanks.
            <p>Andrey.'
        ]);
    }
}
