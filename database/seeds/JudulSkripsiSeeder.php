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
                'judul' => 'SISTEM INFORMASI BIMBINGAN ONLINE',
                'deskripsi' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_mahasiswa' => 2,
                'judul' => 'SISTEM INFORMASI PERPUSTAKAAN',
                'deskripsi' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_mahasiswa' => 3,
                'judul' => 'SISTEM INFORMASI PENDATAAN BARANG',
                'deskripsi' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_mahasiswa' => 4,
                'judul' => 'SISTEM INFORMASI PENGGAJIAN',
                'deskripsi' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_mahasiswa' => 5,
                'judul' => 'SISTEM INFORMASI PENANGANAN MESIN',
                'deskripsi' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_mahasiswa' => 6,
                'judul' => 'SISTEM INFORMASI HANDLING KOMPLAIN',
                'deskripsi' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_mahasiswa' => 7,
                'judul' => 'SISTEM INFORMASI PENJUALAN PADA PT.SAMPOERNA',
                'deskripsi' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_mahasiswa' => 8,
                'judul' => 'SISTEM INFORMASI PENITIPAN ANAK',
                'deskripsi' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_mahasiswa' => 9,
                'judul' => 'SISTEM INFORMASI LANDRY',
                'deskripsi' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_mahasiswa' => 10,
                'judul' => 'SISTEM INFORMASI RUMAH SAKIT',
                'deskripsi' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
