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
            ],
            [
                'nim' => '7201160116',
                'nama_lengkap' => 'Rudi Kurniawan ',
                'password' => bcrypt('7201160116'),
                'email'  => 'rudi@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160117',
                'nama_lengkap' => 'Rizky suganda ',
                'password' => bcrypt('7201160117'),
                'email'  => 'rizky@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160118',
                'nama_lengkap' => 'Yusrian',
                'password' => bcrypt('7201160118'),
                'email'  => 'yusrian@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160119',
                'nama_lengkap' => 'Irpan',
                'password' => bcrypt('7201160119'),
                'email'  => 'irpan@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160120',
                'nama_lengkap' => 'Eva Sulasti',
                'password' => bcrypt('7201160120'),
                'email'  => 'eva@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160121',
                'nama_lengkap' => 'Amar Quraish',
                'password' => bcrypt('7201160121'),
                'email'  => 'amar@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160122',
                'nama_lengkap' => 'Surya Koswara',
                'password' => bcrypt('7201160122'),
                'email'  => 'surya@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160123',
                'nama_lengkap' => 'Effendi suhendi',
                'password' => bcrypt('7201160123'),
                'email'  => 'efendi@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nim' => '7201160124',
                'nama_lengkap' => 'Dian Febrianti',
                'password' => bcrypt('7201160124'),
                'email'  => 'dian@gmail.com',
                'id_jurusan' => 1,
                'no_telp' => '081317726873',
                'angkatan' => '2016',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
