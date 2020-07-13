<?php

use Illuminate\Database\Seeder;

class KategoriBimbinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori_bimbingan')->insert([
            [
                'nama_kategori' => 'BAB 1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_kategori' => 'BAB 2',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_kategori' => 'BAB 3',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_kategori' => 'BAB 4',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_kategori' => 'BAB 5',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_kategori' => 'BAB 6',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
