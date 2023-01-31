<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class TestExport implements FromCollection
{
    private $rows;

    public function __construct($rows)
    {
        $this->rows = $rows;
    }

    public function collection()
    {
        return $this->rows;
    }
}
