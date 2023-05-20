<?php

namespace Database\Seeders;

use App\Models\MuhlatiEtibor;
use Illuminate\Database\Seeder;

class MuhlatiEtiborSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $muhlatho = [
          ['name'=>'Муҳлатнок'], ['name'=>'Бемуҳлат']
       ];

       foreach ($muhlatho as $muhlat){
           MuhlatiEtibor::create($muhlat);
       }
    }
}
