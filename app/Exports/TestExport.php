<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class TestExport implements FromArray
{
    private $rows;

    public function __construct($rows)
    {
        $this->rows = $rows;
    }

    public function array(): array
    {
        return $this->rows;
    }
}
