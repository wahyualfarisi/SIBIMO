<?php

use Illuminate\Database\Seeder;

class KaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kaprodi')->insert([
            [
                'id_account' => 2, //FAUZIAH,
                'id_jurusan' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 7, //ALEX,
                'id_jurusan' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
