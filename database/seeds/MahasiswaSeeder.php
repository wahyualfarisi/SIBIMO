<?php

use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mahasiswa')->insert([
            [
                'nim' => '7201160111',
                'nama_lengkap' => 'Wahyu Alfarisi',
                'password' => bcrypt('7201160111'),
                'email'  => 'wahyualfarisi30@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2015',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160112',
                'nama_lengkap' => 'Zacky',
                'password' => bcrypt('7201160112'),
                'email'  => 'zacky@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2015',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160113',
                'nama_lengkap' => 'Sulaiman',
                'password' => bcrypt('7201160113'),
                'email'  => 'sulaiman@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2015',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
