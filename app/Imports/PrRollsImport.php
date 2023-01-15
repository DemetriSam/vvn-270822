<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\PrRoll;
use App\Models\PrCvet;
use App\Models\PrCollection;
use App\Models\Category;

class PrRollsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $this->createStructureOfProduct($row);
        }
    }

    private function createStructureOfProduct($row)
    {
        $roll = PrRoll::firstOrNew([
            'vendor_code' => $row[0],
            'quantity_m2' => $row[1],
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

        $category = Category::create(['name' => 'placholder']);

        $category->prCollections()->save($collection);
        $collection->prCvets()->save($cvet);
        $cvet->prRolls()->save($roll);
    }
}
