<?php

use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusan')->insert([
            [
                'id_fakultas'   => 1,
                'nama_jurusan'  => 'Sistem Informasi (SI)',
                'created_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id_fakultas'   => 1,
                'nama_jurusan'  => 'Sistem Komputer (SK)',
                'created_at'    => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
