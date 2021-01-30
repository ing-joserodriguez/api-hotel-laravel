<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoHabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10 ; $i++) 
        { 
            $n = $i + 1;
            DB::table('tipos_habitacion')->insert([
                'nombre' => 'Tipo '.$n
            ]);
        }
    }
}
