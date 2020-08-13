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
                'nim' => '7201160115',
                'nama_lengkap' => 'Zacky Ramadhan',
                'password' => bcrypt('7201160115'),
                'email'  => 'zacky@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
