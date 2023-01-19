<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Supplier;
use App\Models\PrCvet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrRoll>
 */
class PrRollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'vendor_code' => fake()->name(),
            'quantity_m2' => 23.22,
            'supplier_id' => Supplier::factory()->create()->id,
            'pr_cvet_id' => PrCvet::factory()->create()->id,
        ];
    }
}
