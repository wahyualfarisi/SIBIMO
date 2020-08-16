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
                'nip'   => '032001111',
                'email' => 'tu@test.com',
                'nama_lengkap' => 'Moh. Kartono S.H',
                'password' => bcrypt('032001111'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'TU',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ //2
                'nip'   => '0320028902',
                'email' => 'fauziah@test.com',
                'nama_lengkap' => 'Fauziah S.KOM, MMSi',
                'password' => bcrypt('0320028902'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'KAPRODI',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ //3
                'nip' => '032001112',
                'email' => 'Jap@test.com',
                'nama_lengkap' => 'Jap Wie Tjhe, S.Kom., M.Kom',
                'password' => bcrypt('032001112'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'DOSEN',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ // 4
                'nip' => '1021098703',
                'email' => 'joshep@test.com',
                'nama_lengkap' => 'Joseph, S.Kom., MM',
                'password' => bcrypt('1021098703'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'DOSEN',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ // 5
                'nip' => '0308067601',
                'email' => 'Gunawan@test.com',
                'nama_lengkap' => 'Bernadus Gunawan Sudarsono, S.T, M.Kom',
                'password' => bcrypt('0308067601'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'DOSEN',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ //6
                'nip' => '0310096701',
                'email' => 'Syahri@test.com',
                'nama_lengkap' => 'Syahrianto, S.Kom., MM',
                'password' => bcrypt('0310096701'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null,
                'level' => 'DOSEN',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [ // 7
                'nip' => '0309087209',
                'email' => 'alex@test.com',
                'nama_lengkap' => 'Alexius Ulan Bani, S.T., M.Kom',
                'password' => bcrypt('0309087209'),
                'no_telp' => null,
                'alamat' => null,
                'foto' => null ,
                'level' => 'KAPRODI',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
