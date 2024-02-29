<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employers = \App\Models\User::employers()->get();
        return [
            'employer_id' => $employers->random()->id,
            'job_title' => fake()->jobTitle(),
            'job_description' => fake()->sentence()
        ];
    }
}
