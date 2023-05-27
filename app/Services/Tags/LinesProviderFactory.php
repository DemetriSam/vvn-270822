<?php

namespace App\Services\Tags;

class LinesProviderFactory implements ProviderFactory
{
    public function getProvider(String $case, Array $args) : LinesProvider
    {
        switch ($case) {
            case 'product':
                return new LinesProviderForProduct($args['product_id']);
            case 'category':
                return new LinesProviderForCategory($args['category_id']);
            case 'color':
                return new LinesProviderForColor($args['category_id'], $args['color_id']);
            case 'selection':
                return new LinesProviderForSelection($args['name']);
            default:
                return new LinesProviderFromLang();
        }
    }
}