<?php

namespace App\Services\Tags;

use App\Models\PrCvet;

class ProductLinesProvider implements LinesProvider
{
    public function __construct($args)
    {
        $this->product = PrCvet::find($args['product_id']);
    }

    public function getString(String $key)
    {
        $map = [
            'category.name' => $this->product->category->name_single ?? $this->product->category->name,
            'product.title' => $this->product->title,
            'description' => $this->product->description,
        ];

        return __($map[$key]);
    }
}