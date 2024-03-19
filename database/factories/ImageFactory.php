<?php

namespace Database\Factories;

use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerFileName = $this->faker->image(
            storage_path("app/data"),
            800,
            600
        );
     
        return [
            'imageable_id' => 
            'url' => $fakerFileName
        ];
    }
}
