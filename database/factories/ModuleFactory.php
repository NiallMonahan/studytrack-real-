<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'code' => strtoupper($this->faker->lexify('??') . $this->faker->numerify('###')),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(10),
        ];
    }
}
