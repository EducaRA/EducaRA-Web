<?php

namespace Database\Factories;

use App\Models\Sala;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipaFactory extends Factory
{
    protected $model = Participa::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sala_id'=> Sala::all()->random()->id,
            'user_id'=> User::all()->random()->id,
        ];
    }
}
