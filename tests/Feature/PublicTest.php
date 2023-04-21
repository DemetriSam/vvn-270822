<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Color;
use App\Models\PrCvet;
use Database\Seeders\TestProductsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class PublicTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Define the test setup.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->seed(TestProductsSeeder::class);
    }

    /**
     * test_all_static_routes_return_200
     *
     * @return void
     */
    public function test_all_static_routes_return_200()
    {
        collect([
            route('index'),
            route('favorites'),
        ])->each(function ($url) {
            $response = $this->get($url);
            try {
                $response->assertStatus(200);
            } catch (\PHPUnit\Framework\AssertionFailedError $e) {
                echo "Assertion failed for URL: {$url}" . PHP_EOL;
                throw $e;
            }
        });
    }

    /**
     * test_all_dynamic_routes_return_200
     *
     * @return void
     */
    public function test_all_dynamic_routes_return_200()
    {
        Category::all()->each(function ($category) {
            $response = $this->get(route('catalog', ['category' => $category]));
            $response->assertStatus(200);
        });

        Color::all()->each(function ($color) {
            Category::all()->each(function ($category) use ($color) {
                if ($category->colors->contains($color)) {
                    $url = route('catalog.color', compact('category', 'color'));
                    $response = $this->get($url);

                    try {
                        $response->assertStatus(200);
                    } catch (\PHPUnit\Framework\AssertionFailedError $e) {
                        echo "Assertion failed for URL: {$url}" . PHP_EOL;
                        throw $e;
                    }
                }
            });
        });

        PrCvet::all()->each(function ($prCvet) {
            if ($prCvet->category === 'carpets') {
                $response = $this->get(route('carpets.product', ['pr_cvet' => $prCvet]));
            } elseif ($prCvet->category === 'cinovki') {
                $response = $this->get(route('cinovki.product', ['pr_cvet' => $prCvet]));
            } else {
                return;
            }

            $response->assertStatus(200);
        });
    }
}
