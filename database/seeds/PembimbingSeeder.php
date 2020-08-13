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
                'id_account' => 7,
                'id_mahasiswa' => 1,
                'pembimbing_status' => '1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 2,
                'id_mahasiswa' => 1,
                'pembimbing_status' => '2',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'id_account' => 4,
                'id_mahasiswa' => 2,
                'pembimbing_status' => '1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 2,
                'id_mahasiswa' => 2,
                'pembimbing_status' => '2',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'id_account' => 4,
                'id_mahasiswa' => 3,
                'pembimbing_status' => '1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 5,
                'id_mahasiswa' => 3,
                'pembimbing_status' => '2',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'id_account' => 2,
                'id_mahasiswa' => 4,
                'pembimbing_status' => '1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 3,
                'id_mahasiswa' => 4,
                'pembimbing_status' => '2',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'id_account' => 6,
                'id_mahasiswa' => 5,
                'pembimbing_status' => '1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 2,
                'id_mahasiswa' => 5,
                'pembimbing_status' => '2',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'id_account' => 6,
                'id_mahasiswa' => 6,
                'pembimbing_status' => '1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 7,
                'id_mahasiswa' => 6,
                'pembimbing_status' => '2',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'id_account' => 2,
                'id_mahasiswa' => 7,
                'pembimbing_status' => '1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 5,
                'id_mahasiswa' => 7,
                'pembimbing_status' => '2',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'id_account' => 6,
                'id_mahasiswa' => 8,
                'pembimbing_status' => '1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 3,
                'id_mahasiswa' => 8,
                'pembimbing_status' => '2',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'id_account' => 2,
                'id_mahasiswa' => 9,
                'pembimbing_status' => '1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 6,
                'id_mahasiswa' => 9,
                'pembimbing_status' => '2',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'id_account' => 3,
                'id_mahasiswa' => 10,
                'pembimbing_status' => '1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_account' => 4,
                'id_mahasiswa' => 10,
                'pembimbing_status' => '2',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
