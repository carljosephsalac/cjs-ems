<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => $this->faker->unique()->numberBetween(1000, 9999),
            'fname' => $this->faker->firstName,
            'lname' => $this->faker->lastName,
            'birthdate' => $this->faker->date(),
            'age' => $this->faker->numberBetween(18, 65),
            'address' => $this->faker->address,
            'salary' => $this->faker->randomFloat(2, 2000, 10000),
        ];
    }
}