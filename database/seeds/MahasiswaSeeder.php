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
                'password' => bcrypt('12345'),
                'email'  => 'wahyualfarisi30@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2015',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}