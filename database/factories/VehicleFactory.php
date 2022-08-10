<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'plate' => $this->faker->regexify('[A-Za-z0-9]{6}'),
            'brand' => $this->faker->company(),
            'color' => rand(0, 1) ? 'Amarillo' : 'Rojo',
            'type' => $this->faker->numberBetween(1, 2),
            'owner_id' => $this->faker->numberBetween(1, 10),
            'driver_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
