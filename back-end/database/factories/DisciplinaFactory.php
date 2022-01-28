<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DisciplinaFactory extends Factory
{
    protected $model = Disciplina::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->word,
            'sigla' => $this->faker->text(10),
        ];
    }
}
