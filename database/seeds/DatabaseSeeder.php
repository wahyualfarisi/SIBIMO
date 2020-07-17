<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call([
            KategoriBimbinganSeeder::class,
            AccountSeeder::class,
            DospemSeeder::class,
            JurusanSeeder::class,
            KaprodiSeeder::class,
            MahasiswaSeeder::class,
            JudulSkripsiSeeder::class
        ]);
    }
}
