<?php

namespace App\Services\Stockupdate;

class RulesFactory
{
    public function getRules($supplier)
    {
        switch ($supplier) {
            case 'dizanarium':
                return new DizanariumRules();
            case 'test':
                return new TestRules();

            case 'fenix':
                return new FenixRules();

            default:
                # code...
                break;
        }
    }
}
