<?php

namespace Database\Seeders;


use App\Models\NamudiShartnoma;
use Illuminate\Database\Seeder;

class NamudiShartnomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $namudho = [
            ['name'=>'Байнидавлатӣ'],
            ['name'=>'Байниҳукуматӣ'],
            ['name'=>'Байниидоравӣ'],
            ['name'=>'Универсалӣ'],
            ['name'=>'Минтақавӣ']
        ];

        foreach ($namudho as $namud){
            NamudiShartnoma::create($namud);
        }
    }
}
