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
                'nama_jurusan'  => 'Sistem Informasi (SI)',
                'created_at'    => date('Y-m-d H:i:s')
            ],
            [
                'nama_jurusan'  => 'Sistem Komputer (SK)',
                'created_at'    => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
