<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClienteSeeder extends Seeder
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
            DB::table('clientes')->insert([
                'ci'              => Str::random(10),
                'nombre_completo' => 'Nombre '.$n,
                'telefono'        => Str::random(20),
                'direccion'       => Str::random(50),
                'correo'          => Str::random(10).'@example.com',
            ]);
        }
    }
}
