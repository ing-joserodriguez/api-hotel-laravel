<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class oauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'name'                   => 'hotel-api',
            'secret'                 => 'VC1nGkMeVPMy9jKjTU4Pqouxv57B6gGE3Avu6Xkr',
            'redirect'               => 'http://localhost',
            'personal_access_client' => true,
            'password_client'        => false,
            'revoked'                => false,
            'created_at'             => date("Y-m-d H:i:s"),
            'updated_at'             => date("Y-m-d H:i:s")
        ]);
    }
}
