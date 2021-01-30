<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HabitacionSeeder extends Seeder
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
            DB::table('habitaciones')->insert([
                'tipo_habitacion_id' => mt_rand(1,10),
                'nombre'             => 'Habitacion '.$n,
            ]);
        }
    }
}
