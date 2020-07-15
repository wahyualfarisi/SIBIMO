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
                'id_account' => 2, // FAUZIAH
                'pembimbing' => 2, // pembimbing 2
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 3, // JAP
                'pembimbing' => 2, // pembimbing 2
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 4, // JOSEPH
                'pembimbimg' => 2, //pembimbing 2
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 5, // GUN
                'pembimbing' => 1, // pembimbing 2
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 6, // SYAHRI
                'pembimbing' => 2, // pembimbing 2
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 7, // ALEX
                'pembimbing' => 1, // pembimbing 1
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
