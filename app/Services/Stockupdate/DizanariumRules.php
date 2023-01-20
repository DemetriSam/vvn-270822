<?php

namespace App\Services\Stockupdate;

class DizanariumRules
{
    public $delTopLines = 1;
    public function getMap()
    {
        return [
            'vendor_code' => 0,
            'quantity_m2' => 3,
        ];
    }
}
