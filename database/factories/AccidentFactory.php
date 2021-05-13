<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class AccidentFactory
 * @package Database\Factories
 */
class AccidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pet = Pet::all()->random();
        $user = User::all()->random();
        return [
            'pet_id' => $pet->id,
            'user_id' => $user->id,
            'city' => $this->faker->city,
            'accident' => $this->faker->shuffleString(),
            'coordinates' => json_encode([])
        ];
    }
}
