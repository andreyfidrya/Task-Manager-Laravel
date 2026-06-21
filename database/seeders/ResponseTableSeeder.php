<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponseTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('responses')->insert([
            [
                'title' => 'В работу',
                'description' => 'Уважаемый клиент, поскольку Ваш вопрос требует больше времени для уточнения, на данный момент мы взяли его в работу и рассмотрим индивидуально. Мы постараемся связаться с Вами как можно скорее и предоставить подробную информацию по данной ситуации. Приносим извинения за причиненные неудобства.',                
            ], 
            [
                'title' => 'Into work',
                'description' => 'Dear customer, as your question requires more time for clarification, at the moment we have taken it into work and will consider it individually. We will try to contact you as soon as possible and provide you with details on this issue. We apologize for any inconvenience caused.',                
            ],           
        ]);
    }
}
