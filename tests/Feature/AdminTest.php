<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Models\Category;
use App\Models\PrCollection;
use App\Models\PrCvet;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class AdminTest extends TestCase
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
        $this->user = User::factory()->create();
        $adminRole = Role::create(['name' => 'admin']);
        $this->user->assignRole($adminRole);
    }

    /**
     * test_all_static_routes_return_200
     *
     * @return void
     */
    public function test_all_static_routes_return_200()
    {
        collect(Route::getRoutes()->getRoutes())
            ->filter(function ($route) {
                return Str::contains($route->uri, 'admin') &&
                    !Str::contains($route->uri, '{') &&
                    in_array('GET', $route->methods);
            })->map(function ($route) {
                return URL::to($route->uri);
            })->each(function ($url) {
                $response = $this->actingAs($this->user)->get($url);
                try {
                    $response->assertStatus(200);
                } catch (\PHPUnit\Framework\AssertionFailedError $e) {
                    echo "Assertion failed for URL: {$url}" . PHP_EOL;
                    throw $e;
                }
            });
    }

    public function test_category_can_be_stored_and_updated()
    {
        $this->actingAs($this->user);
        $newCategory = Category::factory()->make()->toArray();
        $this->post(route('categories.store'), $newCategory)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('categories', $newCategory);

        $category = Category::first();
        $this->get(route('categories.edit', ['category' => $category->id]))
            ->assertStatus(200);

        $category->name = 'Updated Value';
        $updatedData = ['name' => 'Updated Value'];
        $this->patch(route('categories.update', ['category' => $category->id]), $category->only('name', 'slug'))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('categories', $updatedData);
    }

    public function test_collection_can_be_stored_and_updated()
    {
        $this->actingAs($this->user);
        $newCollection = PrCollection::factory()->make()->toArray();
        $this->post(route('pr_collections.store'), $newCollection)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('pr_collections', $newCollection);

        $prCollection = PrCollection::first();
        $this->get(route('pr_collections.edit', ['pr_collection' => $prCollection->id]))
            ->assertStatus(200);

        $updatedData = $prCollection
            ->only('name', 'category_id', 'default_price');
        $updatedData['name'] = 'Updated Value';
        $this->patch(route('pr_collections.update', ['pr_collection' => $prCollection->id]), $updatedData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('pr_collections', $updatedData);
    }

    public function test_cvet_can_be_stored_and_updated()
    {
        $this->actingAs($this->user);
        $newCvet = PrCvet::factory()->make()
            ->only('name_in_folder', 'pr_collection_id');
        $this->post(route('pr_cvets.store'), $newCvet)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('pr_cvets', $newCvet);

        $prCvet = PrCvet::first();
        $this->get(route('pr_cvets.edit', ['pr_cvet' => $prCvet->id]))
            ->assertStatus(200);

        $updatedData = $prCvet
            ->only('name_in_folder', 'pr_collection_id');
        $updatedData['name_in_folder'] = 'Updated Value';
        $this->patch(route('pr_cvets.update', ['pr_cvet' => $prCvet->id]), $updatedData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('pr_cvets', $updatedData);
    }

    public function test_color_can_be_stored_and_updated()
    {
        $this->actingAs($this->user);
        $newColor = Color::factory()->make()
            ->toArray();
        $this->post(route('colors.store'), $newColor)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('colors', $newColor);

        $color = Color::first();
        $this->get(route('colors.edit', ['color' => $color->id]))
            ->assertStatus(200);

        $updatedData = $color
            ->only('name', 'slug', 'color_hash');
        $updatedData['name'] = 'Updated Value';
        $this->patch(route('colors.update', ['color' => $color->id]), $updatedData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('colors', $updatedData);
    }

    public function test_pictures_can_be_uploaded()
    {
        $path = __DIR__ . '/Fixtures/images';
        $files = scandir($path);
        $files = collect($files)
            ->reject(fn ($file) => $file === '.' or $file === '..')
            ->map(function ($name) use ($path) {
                $fileObject = new File($path . '/' . $name);
                Storage::putFileAs('', $fileObject, $name);
                $filePath = Storage::path($name);
                return new UploadedFile($filePath, $name, null, null, true);
            })->toArray();

        $newCvet = PrCvet::factory()->create();
        $id = $newCvet->id;
        $fields = $newCvet->only('name_in_folder', 'pr_collection_id');

        $this->actingAs($this->user);

        $this->call(
            'PATCH',
            route('pr_cvets.update', ['pr_cvet' => $id]),
            $fields,
            [],
            $files
        )->assertSessionHasNoErrors()->assertRedirect();
    }
}