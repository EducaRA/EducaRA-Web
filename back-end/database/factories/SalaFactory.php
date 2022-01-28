<?php

namespace Database\Factories;

use App\Models\Disciplina;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaFactory extends Factory
{
    protected $model = Sala::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo'=> $this->faker->md5,
            'nome'=> $this->faker->sentence(),
            'dono'=> User::all()->random()->id,
            'disciplina_id'=> Disciplina::all()->random()->id,
        ];
    }
}
