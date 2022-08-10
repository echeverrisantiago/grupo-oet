<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'identification' => $this->faker->numberBetween(100000, 9999999999),
            'first_name' => $this->faker->firstName(),
            'second_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'address' => $this->faker->address(),
            'telephone' => $this->faker->numberBetween(2222222, 9999999),
            'city' => $this->faker->city()
        ];
    }
}
