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
use Illuminate\Support\Facades\DB;

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
        $runOut = PrRoll::factory()->for($this->supplier)->count(3)->create(['vendor_code' => 'will_run_out_of_stock', 'quantity_m2' => 50]);
        $comeIn = PrRoll::factory()->for($this->supplier)->count(3)->create(['vendor_code' => 'will_come_in', 'quantity_m2' => 0]);
        $current = PrRoll::where('supplier_id', $this->supplier->id)->get();
        $this->slugger->setUniqueSlugs($current, 'vendor_code', 'slug')->each(fn ($row) => $row->save());

        $this->cvetRunOut = PrCvet::factory()->create(['published' => 'true']);
        $runOut->each(fn ($roll) => $roll->prCvet()->associate($this->cvetRunOut));

        $this->cvetComeIn = PrCvet::factory()->create(['published' => 'false']);
        $comeIn->each(fn ($roll) => $roll->prCvet()->associate($this->cvetComeIn));
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

        $status = DB::table('pr_cvets')->where('id', $this->cvetRunOut->id)->first()->published;
        $quantity = $this->cvetRunOut->quantity;
        $this->cvetRunOut->refresh();
        $this->assertFalse($this->cvetRunOut->isPublished());

        $this->cvetComeIn->refresh();
        $this->assertTrue($this->cvetComeIn->isPublished());
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
            [
                'vendor_code' => 'will_run_out_of_stock',
                'quantity_m2' => 1,
            ],
            [
                'vendor_code' => 'will_run_out_of_stock',
                'quantity_m2' => 2,
            ],
            [
                'vendor_code' => 'will_run_out_of_stock',
                'quantity_m2' => 0,
            ],
            [
                'vendor_code' => 'will_come_in',
                'quantity_m2' => 100,
            ],
        ];
        return [
            [collect($fixture)],
        ];
    }
}
