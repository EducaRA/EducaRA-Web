<?php

use App\Models\Participa;
use Illuminate\Database\Seeder;

class ParticipaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Participa::truncate();
        Participa::factory()->count(200)->make();
    }
}
