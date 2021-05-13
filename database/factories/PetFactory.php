<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\PetType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class PetFactory
 * @package Database\Factories
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $petType = PetType::all()->random();
        return [
            'name' => $this->faker->name(),
            'type_id' => $petType->id,
            'years' => $this->faker->numberBetween(1,50),
            'description' => $this->faker->shuffleString()
        ];
    }
}
