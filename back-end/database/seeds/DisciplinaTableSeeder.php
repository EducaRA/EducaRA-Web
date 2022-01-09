<?php

use App\Models\Disciplina;
use Illuminate\Database\Seeder;

class DisciplinaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disciplina::truncate();
        Disciplina::factory()->count(30)->make();
    }
}
