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
                'nim' => '7201160117',
                'nama_lengkap' => 'Muhammad Zacky Ramadhan',
                'password' => bcrypt('7201160117'),
                'email'  => 'zacky@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160116',
                'nama_lengkap' => 'Nur Irfan',
                'password' => bcrypt('7201160116'),
                'email'  => 'rudi@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160119',
                'nama_lengkap' => 'Moh. Fahmi Thorik ',
                'password' => bcrypt('7201160119'),
                'email'  => 'rizky@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160114',
                'nama_lengkap' => 'M. Yusriansyah K.P',
                'password' => bcrypt('7201160114'),
                'email'  => 'yusrian@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
