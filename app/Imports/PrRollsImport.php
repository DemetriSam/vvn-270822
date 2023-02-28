<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Services\Stockupdate\RulesFactory;

class PrRollsImport implements ToCollection, WithCalculatedFormulas
{
    private $supplier;
    private $rules;
    private $import;

    public function __construct(string $supplier)
    {
        $this->supplier = $supplier;
        $factory = new RulesFactory();
        $this->rules = $factory->getRules($supplier);
    }

    public function get()
    {
        return $this->import;
    }

    public function collection(Collection $rows)
    {
        for ($i = 0; $i < $this->rules->delTopLines; $i++) {
            $rows->shift();
        }

        $map = $this->rules->getMap();
        $supplier = $this->supplier;

        $import = $rows->map(function ($row) use ($map, $supplier) {
            $vendor_code = $row[$map['vendor_code']];
            $quantity_m2 = $row[$map['quantity_m2']];
            return compact('vendor_code', 'quantity_m2', 'supplier');
        });

        $this->import = $import;
    }
}
