<?php

namespace App\Services\Tags;

use App\Models\PrCvet;

class LinesProviderForProduct implements LinesProvider
{
    public function __construct($id)
    {
        $this->product = PrCvet::find($id);
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