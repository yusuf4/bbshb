<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['name'=>"Афганистан"],
            ['name'=>"Албания"],
            ['name'=>"Алжир"],
            ['name'=>"Самоа"],
            ['name'=>"Андорра"],
            ['name'=>"Ангола"],
            ['name'=>"Ангилья"],
            ['name'=>"Антигуа и Барбуда"],
            ['name'=>"Аргентина"],['name'=>"Армения"],['name'=>"Аруба"],['name'=>"Австралия"],['name'=>"Австрия"],['name'=>"Азербайджан"],['name'=>"Бахрейн"],['name'=>"Бангладеш"],['name'=>"Барбадос"],
            ['name'=>"Белоруссия"],['name'=>"Бельгия"],['name'=>"Бенин"],['name'=>"Бермуды"],['name'=>"Бутан"],['name'=>"Боливия"],['name'=>"Босния и Герцеговина"],['name'=>"Ботсвана"],['name'=>"Бразилия"]
        ];
        foreach ($countries as $davlat){
            Country::create($davlat);
        }
    }
}
