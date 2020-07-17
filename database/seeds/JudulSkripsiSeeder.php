<?php

use Illuminate\Database\Seeder;

class JudulSkripsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('judul_skripsi')->insert([
            [
                'id_mahasiswa' => 1,
                'judul' => 'SISTEM INFORMASI PREVENTIVE MAINTENANCE',
                'deskripsi' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
