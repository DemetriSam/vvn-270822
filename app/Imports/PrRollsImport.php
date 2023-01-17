<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\PrRoll;
use App\Models\PrCvet;
use App\Models\PrCollection;
use App\Models\Category;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PrRollsImport implements ToCollection, WithCalculatedFormulas
{
    private $supplier;
    private $mappers;

    public function __construct(string $supplier)
    {
        $this->supplier = $supplier;
        $this->mappers = [
            'test' => [
                'vendor_code' => 0,
                'quantity_m2' => 1,
            ],
            'dizanarium' => [
                'vendor_code' => 0,
                'quantity_m2' => 3,
            ]
        ];
    }

    public function collection(Collection $rows)
    {
        $rows->shift();
        foreach ($rows as $row) {
            $this->createStructureOfProduct($row);
        }
    }

    private function createStructureOfProduct($row)
    {
        $supplier = Supplier::firstOrCreate(['name' => $this->supplier]);
        $mapper = $this->mappers[$this->supplier];
        $vendor_code = $row[$mapper['vendor_code']];
        $quantity_m2 = $row[$mapper['quantity_m2']];
        if($row[$mapper['quantity_m2']] === null) {
            return;
        }
        
        $roll = PrRoll::firstOrNew([
            'vendor_code' => $vendor_code,
            'quantity_m2' => $quantity_m2,
            'supplier_id' => $supplier->id,
        ]);

        $cvet = PrCvet::firstOrNew([
            'name_in_folder' => 'placeholder',
            'title' => 'placeholder',
            'current_price' => 0,
        ]);

        $collection = PrCollection::firstOrNew([
            'name' => 'placeholder',
            'default_price' => 0,
        ]);

        $category = Category::firstOrcreate(['name' => 'placeholder']);

        $category->prCollections()->save($collection);
        $collection->prCvets()->save($cvet);
        $cvet->prRolls()->save($roll);
    }
}
