<?php

namespace App\Services\Stockupdate;

class DizanariumRules
{
    public $delTopLines = 2;

    public function getMap()
    {
        return [
            'vendor_code' => 1,
            'quantity_m2' => 3,
        ];
    }
}
