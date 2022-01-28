<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('set foreign_key_checks = 0');

        $this->call(UserTableSeeder::class);
        $this->call(DisciplinaTableSeeder::class);
        $this->call(ObjetoTableSeeder::class);
        $this->call(SalaTableSeeder::class);

        DB::statement('set foreign_key_checks = 1');
    }
}
