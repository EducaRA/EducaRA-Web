<?php

use App\Models\Sala;
use Illuminate\Database\Seeder;

class SalaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sala::truncate();
        Sala::factory()->times(30)->create();
    }
}
