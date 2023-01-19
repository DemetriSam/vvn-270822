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
use App\Services\Stockupdate\RulesFactory;

class PrRollsImport implements ToCollection, WithCalculatedFormulas
{
    private $supplier;
    private $rules;

    public function __construct(string $supplier, $save = false)
    {
        $this->supplier = $supplier;
        $factory = new RulesFactory();
        $this->rules = $factory->getRules($supplier);
        $this->save = $save;
    }

    public function get()
    {
        return $this->import;
    }

    public function collection(Collection $rows)
    {
        $rows->shift();        
        $map = $this->rules->getMap();
        $supplier = $this->supplier;

        $import = $rows->map(function($row) use ($map, $supplier) {
            $vendor_code = $row[$map['vendor_code']];
            $quantity_m2 = $row[$map['quantity_m2']];
            return compact('vendor_code', 'quantity_m2', 'supplier');
        });

        $this->import = $import;
        
        if($this->save) {$this->createStructureOfProducts($import);}
    }

    private function createStructureOfProducts($import)
    {
        $supplier = Supplier::firstOrCreate(['name' => $this->supplier]);

        $import->each(function ($i) use ($supplier) {
            $roll = PrRoll::firstOrNew([
                'vendor_code' => $i['vendor_code'],
                'quantity_m2' => isset($i['quantity_m2']) ? $i['quantity_m2'] : 0,
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
        });
    }
}
