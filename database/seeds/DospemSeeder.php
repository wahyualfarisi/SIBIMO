<?php

use Illuminate\Database\Seeder;

class DospemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dospem')->insert([
            [
                'id_account' => 2, //FAUZIAH
                'pembimbing' => 1, // pembimbing 1
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 3, //JAP
                'pembimbing' => 2, // pembimbing 2
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 4, //IZUL
                'pembimbimg' => 2, //pembimbing 2
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 5, //SRI
                'pembimbing' => 2, // pembimbing 2
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 6, //SRI
                'pembimbing' => 2, // pembimbing 2
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
