<?php

namespace Database\Seeders;


use App\Models\TartibiEtibor;
use Illuminate\Database\Seeder;

class TartibiEtiborSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $namudho = [
            ['name'=>'Қарори Ҳукумати ҶТ'],
            ['name'=>'Фармони Президенти ҶТ'],
            ['name'=>'Қарори Маҷлиси намояндагони Маҷлиси Олии ҶТ'],
            ['name'=>'Аз лаҳзаи имзо'],
            ['name'=>'Дигар']
        ];

        foreach ($namudho as $namud){
            TartibiEtibor::create($namud);
        }
    }
}
