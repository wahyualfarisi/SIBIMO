<?php

use Illuminate\Database\Seeder;

class PembimbingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pembimbing')->insert([
            [
                'id_dospem' => 1,
                'id_mahasiswa' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_dospem' => 6,
                'id_mahasiswa' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
