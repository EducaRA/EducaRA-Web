<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ObjetoFactory extends Factory
{
    protected $model = Objeto::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome'=> $this->faker->word,
            'descricao'=> $this->faker->sentence(),
            'filehash'=> $this->faker->md5,
            'size'=> $this->faker->randomNumber(),
            'extension'=> $this->faker->fileExtension,
            'path'=> $this->faker->word,
        ];
    }
}
