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
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromArray;
use App\Exports\TestExport;


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

    /**
     * Test the uploadExcelFile method.
     * 
     * @dataProvider provideFixtures
     * @return void
     */
    public function testUploadExcelFile($supplier, $fixture)
    {
        $fileName = implode([$supplier, '.xlsx']);
        Excel::store(new TestExport($fixture), $fileName, 'public');
        $filePath = Storage::disk('public')->path($fileName);
        $file = new UploadedFile($filePath, $fileName, null, null, true);

        $response = $this->actingAs($this->user)
            ->call('POST', route('upload.excel'), [], [], ['excel_file' => $file], [])
            ->assertSessionHasNoErrors() 
            ->assertRedirect();
    
        foreach($fixture as $record) {
            $this->assertDatabaseHas('pr_rolls', $record);
        }
    }

    public function provideFixtures()
    {
        return [
            ['test', [
                [
                    'vendor_code' => 'Vendor1',
                    'quantity_m2' => 100,
                ],
                [
                    'vendor_code' => 'Vendor2',
                    'quantity_m2' => 200,
                ],
            ]],
        ];
    }
}
