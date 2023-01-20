<?php

namespace App\Services\Stockupdate;

class TestRules
{
    public $delTopLines = 0;
    public function getMap()
    {
        return [
            'vendor_code' => 0,
            'quantity_m2' => 1,
        ];
    }
}
