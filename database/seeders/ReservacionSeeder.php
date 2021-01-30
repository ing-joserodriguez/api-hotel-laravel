<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservaciones')->insert([
            [
                'cliente_id'    => '1',
                'habitacion_id' => '1',
                'check_in'      => '2021-01-30 08:00:00',
                'check_out'     => '2021-01-31 14:00:00'
            ],
            [
                'cliente_id'    => '2',
                'habitacion_id' => '1',
                'check_in'      => '2021-01-31 14:00:00',
                'check_out'     => '2021-02-02 14:00:00'
            ],
            [
                'cliente_id'    => '3',
                'habitacion_id' => '2',
                'check_in'      => '2021-01-31 08:00:00',
                'check_out'     => '2021-02-01 14:00:00'
            ],
            [
                'cliente_id'    => '4',
                'habitacion_id' => '3',
                'check_in'      => '2021-02-01 08:00:00',
                'check_out'     => '2021-02-05 14:00:00'
            ],
            [
                'cliente_id'    => '5',
                'habitacion_id' => '3',
                'check_in'      => '2021-02-10 08:00:00',
                'check_out'     => '2021-02-11 14:00:00'
            ]
        ]);
    }
}
