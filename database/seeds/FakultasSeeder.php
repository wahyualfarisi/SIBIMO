<?php

use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fakultas')->insert([
            [ //1
                'kode_fakultas' => 'F-ILKOM',
                'nama_fakultas' => 'Ilmu Komputer',
                'created_at'    => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
