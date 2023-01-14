<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\PrCvet;
use App\Models\PrRoll;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PrRollControllerTest extends TestCase
{

    use RefreshDataBase;

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
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function upload_csv_file_creates_rolls()
    {
        // create a test csv file with sample data
        $file = new UploadedFile(base_path('tests/Feature/Fixtures/sample.csv'), 'sample.csv', 'text/csv', null, true);
        $this->actingAs($this->user)
            ->json('POST', route('upload.csv'), ['csv_file' => $file])
            ->assertRedirect();

        // check that the product quantity is correct
        $product = PrCvet::find(1);
        $this->assertEquals(25, $product->quantity);

        // check that a roll's quantity is correct
        $roll = PrRoll::find(1);
        $this->assertEquals(10, $roll->quantity_m2);
                
        // check that the correct number of rolls have been created
        $rolls = PrRoll::where('pr_cvet_id', 1)->get();
        $this->assertCount(3, $rolls);


    }
}
