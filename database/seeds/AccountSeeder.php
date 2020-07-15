<?php

use Illuminate\Database\Seeder;


class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $no = 1;

        DB::table('account')->insert([
            [ //1
                'nip'   => '7343201110'.$no++,
                'email' => 'tu@test.com',
                'nama_lengkap' => 'Tono Sutono S.KOM',
                'password' => bcrypt('12345'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'TU',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ //2
                'nip'   => '72111210'.$no++,
                'email' => 'fauziah@test.com',
                'nama_lengkap' => 'Fauziah S.KOM, M.KOM',
                'password' => bcrypt('12345'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'KAPRODI',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ //3
                'nip' => '720134110'.$no++,
                'email' => 'Jap@test.com',
                'nama_lengkap' => 'JAP S.KOM, M.KOM',
                'password' => bcrypt('12345'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'DOSEN',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ // 4
                'nip' => '7201110345'.$no++,
                'email' => 'joshep@test.com',
                'nama_lengkap' => 'Joseph S.KOM, M.KOM',
                'password' => bcrypt('12345'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'DOSEN',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ // 5
                'nip' => '7201110454'.$no++,
                'email' => 'Gunawan@test.com',
                'nama_lengkap' => 'Gunawan  M.KOM',
                'password' => bcrypt('12345'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'DOSEN',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ //6
                'nip' => '720110454'.$no++,
                'email' => 'Syahri@test.com',
                'nama_lengkap' => 'Syahrianto',
                'password' => bcrypt('12345'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'DOSEN',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ // 7
                'nip' => '7201160111'.$no++,
                'email' => 'alex@test.com',
                'nama_lengkap' => 'Alex',
                'password' => bcrypt('12345'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null ,
                'level' => 'KAPRODI',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
