<?php

namespace App\Services\Tags;

use Exception;

class LinesProviderFactory implements ProviderFactory
{
    public function getProvider(String $case, Array $args) : LinesProvider
    {
        switch ($case) {
            case 'product':
                return new ProductLinesProvider($args);
            case 'category':
                return new CategoryLinesProvider($args);
            case 'color':
                return new ColorLinesProvider($args);
            case 'selection':
                return new SelectionLinesProvider($args);
            default:
                throw new Exception('Such Lines Provider does not exist');
        }
    }
}