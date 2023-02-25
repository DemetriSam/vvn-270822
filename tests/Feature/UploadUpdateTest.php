<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\PrRoll;
use App\Models\Supplier;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Exports\TestExport;
use App\Models\PrCvet;
use Illuminate\Http\File;
use App\Services\Stockupdate\Slugger;

class UploadUpdateTest extends TestCase
{
    use RefreshDataBase;

    const SUPPLIER = 'test';

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

        $this->slugger = new Slugger();

        $this->supplier = Supplier::firstOrCreate(['name' => self::SUPPLIER]);
        PrRoll::factory()->for($this->supplier)->count(3)->create(['vendor_code' => 'old']);
        PrRoll::factory()->for($this->supplier)->count(2)->create(['vendor_code' => 'changed']);
        PrRoll::factory()->for($this->supplier)->count(1)->create(['vendor_code' => 'same', 'quantity_m2' => 23.22]);
        $current = PrRoll::where('supplier_id', $this->supplier->id)->get();
        $this->slugger->setUniqueSlugs($current, 'vendor_code', 'slug')->each(fn ($row) => $row->save());
    }

    public function test_public_status_depends_on_quantity()
    {
        $rolls = PrRoll::factory()->for($this->supplier)->count(3)->create(['vendor_code' => 'test quantity']);
        $cvet = PrCvet::factory()->create();
        $rolls->each(function ($roll) use ($cvet) {
            $roll->prCvet()->associate($cvet);
            $roll->save();
        });

        $cvet->publish();
        $this->assertTrue($cvet->getPublicStatus());

        $cvet->retract();
        $this->assertFalse($cvet->getPublicStatus());

        $cvet->publish();

        $rolls->each(function ($roll) use ($cvet) {
            $roll->quantity_m2 = 0;
            $roll->save();
        });

        $this->assertFalse($cvet->getPublicStatus());
    }

    public function testUploadPageCanRender()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('upload.form'));

        $response->assertStatus(200);
    }

    /**
     * Test the uploadExcelFile method.
     *
     * @dataProvider provideFixtures
     * @return void
     */
    public function testUploadExcelFile($fixture)
    {
        $fileName = implode([$this->supplier->name, '.xlsx']);

        if ($fixture !== null) {
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
        $this->actingAs($this->user);

        $this->call(
            'POST',
            route('upload.excel'),
            ['supplier_id' => $this->supplier->id],
            [],
            ['excel_file' => $file],
        )->assertSessionHasNoErrors()->assertRedirect();

        $this->post(route('upload.update.db', ['supplier_id' => $this->supplier->id]))
            ->assertSessionHasNoErrors()->assertRedirect();

        foreach ($fixture as $record) {
            $this->assertDatabaseHas('pr_rolls', $record);
        }

        $this->assertDataBaseMissing('pr_rolls', ['vendor_code' => 'old']);
    }

    public function provideFixtures()
    {
        $fixture = [
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
                'quantity_m2' => 200.00,
            ],
            [
                'vendor_code' => 'changed',
                'quantity_m2' => 200.23,
            ],
            [
                'vendor_code' => 'changed',
                'quantity_m2' => 300,
            ],
        ];
        return [
            [collect($fixture)],
        ];
    }
}
