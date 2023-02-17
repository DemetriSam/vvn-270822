<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\PrCollection;
use App\Models\PrCvet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carpets = Category::firstWhere('slug', 'carpets');
        $cinovki = Category::firstWhere('slug', 'cinovki');
        $coll1 = PrCollection::factory()->create(['category_id' => $carpets->id]);
        $coll2 = PrCollection::factory()->create(['category_id' => $cinovki->id]);

        $prods1 = PrCvet::factory()->count(40)
            ->create([
                'pr_collection_id' => $coll1->id,
                'color_id' => Color::find(1)->id,
            ]);

        $prods2 = PrCvet::factory()->count(40)
            ->create([
                'pr_collection_id' => $coll1->id,
                'color_id' => Color::find(2)->id,
            ]);

        $prods3 = PrCvet::factory()->count(40)
            ->create([
                'pr_collection_id' => $coll2->id,
                'color_id' => Color::find(1)->id,
            ]);

        $prods2 = PrCvet::factory()->count(40)
            ->create([
                'pr_collection_id' => $coll2->id,
                'color_id' => Color::find(2)->id,
            ]);
    }
}
