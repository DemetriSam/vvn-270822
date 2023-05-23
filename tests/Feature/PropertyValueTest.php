<?php

namespace Tests\Feature;

use App\Models\PrCollection;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Models\User;
use Database\Seeders\TestProductsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PropertyValueTest extends TestCase
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
        $this->user = User::first();
    }

    public function test_index()
    {
        $this->actingAs($this->user);
        $this->get(route('property_values.index'))->assertOk();
    }

    public function test_update()
    {
        $this->actingAs($this->user);
        $collection = PrCollection::first();

        $fields = $collection->only(
            'name',
            'nickname',
            'description',
            'default_price',
            'category_id',
        );

        $property = Property::first();
        $propvals = PropertyValue::all()->where('property_id', $property->id);
        $ex = [];

        foreach($propvals as $propval) {
            $fields['properties'] = [$propval->property_id => $propval->id];
            $this->patch(route('pr_collections.update', ['pr_collection' => $collection->id]), $fields)->assertRedirect();
            $record = ['pr_collection_id' => $collection->id, 'property_value_id' => $propval->id];
            $this->assertDatabaseHas('pr_collection_property_value', $record);

            foreach($ex as $exrecord) {
                $this->assertDatabaseMissing('pr_collection_property_value', $exrecord);
            }

            $ex[] = $record;
        }
    }
}
