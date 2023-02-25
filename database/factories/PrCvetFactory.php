<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PrCollection;
use App\Models\PrRoll;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrCvet>
 */
class PrCvetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name_in_folder' => fake()->name(),
            'title' => fake()->name(),
            'pr_collection_id' => PrCollection::factory()->create()->id,
            'published' => 'true',
            'prRolls' => PrRoll::factory()->count(3)->create(),
        ];
    }
}
