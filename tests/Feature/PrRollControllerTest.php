<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\PrCvet;
use App\Models\PrCollection;
use App\Models\PrRoll;
use App\Models\Category;
use App\Models\Supplier;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Exports\TestExport;
use App\Imports\PrRollsImport;
use Illuminate\Http\File;
use App\Services\Stockupdate\Slugger;

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
    public function testUploadExcelFile($supplier, $fixture = null)
    {
        $slugger = new Slugger;
        //create test data in db
        PrRoll::factory()
            ->for(Supplier::firstOrCreate(['name' => $supplier]))
            ->count(3)
            ->create(['vendor_code' => 'old']);

        PrRoll::factory()
            ->for(Supplier::firstOrCreate(['name' => $supplier]))
            ->count(2)
            ->create(['vendor_code' => 'changed']);

        PrRoll::factory()
            ->for(Supplier::firstOrCreate(['name' => $supplier]))
            ->count(1)
            ->create(['vendor_code' => 'same', 'quantity_m2' => 23.22]);

        $current = PrRoll::where(
            'supplier_id',
            Supplier::where('name', $supplier)->first()->id,
        )->get();

        $slugger
            ->setUniqueSlugs($current, 'vendor_code', 'slug')
            ->each(fn ($row) => $row->save());

        $fileName = implode([$supplier, '.xlsx']);
        if (is_array($fixture)) {
            $fixture = collect($fixture);
            $fixture = $slugger->setUniqueSlugs($fixture, 'vendor_code', 'slug');
            Excel::store(new TestExport($fixture), $fileName);
        } else {
            $file = new File(__DIR__ . '/Fixtures/' . $fileName);
            $fileName = Storage::putFileAs('', $file, $fileName);
            $fixture = collect([
                ['vendor_code', 'quantity_m2'],
                ['vendor_code' => 'BASTILLE 09022967', 'quantity_m2' => '51.72'],
            ]);
        }
        $filePath = Storage::path($fileName);
        $file = new UploadedFile($filePath, $fileName, null, null, true);

        $response = $this->actingAs($this->user)
            ->call('POST', route('upload.excel', compact('supplier')), [], [], ['excel_file' => $file], [])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        // $fixture->shift();
        foreach ($fixture as $record) {
            $this->assertDatabaseHas('pr_rolls', $record);
        }

        $this->assertDataBaseMissing('pr_rolls', ['vendor_code' => 'old']);
    }

    public function provideFixtures()
    {
        return [
            [
                'test',
                [
                    [
                        'vendor_code' => 'new',
                        'quantity_m2' => 100,
                    ],
                    [
                        'vendor_code' => 'new',
                        'quantity_m2' => 200,
                    ],
                    [
                        'vendor_code' => 'new',
                        'quantity_m2' => 300,
                    ],
                    [
                        'vendor_code' => 'same',
                        'quantity_m2' => 23.22,
                    ],
                    [
                        'vendor_code' => 'changed',
                        'quantity_m2' => 200,
                    ],
                    [
                        'vendor_code' => 'changed',
                        'quantity_m2' => 200,
                    ],
                ],
            ],
            // ['dizanarium'],
        ];
    }
}
