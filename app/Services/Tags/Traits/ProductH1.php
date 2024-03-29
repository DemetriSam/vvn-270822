<?php

namespace App\Services\Tags\Traits;

use App\Services\Tags\LinesProvider;

trait ProductH1
{
    public function getH1()
    {
        $provider = $this->getLineProvider();
        $prefix = $provider->getString('category.name');
        $productName = $provider->getString('product.title');
        return $prefix . ' ' . $productName;
    }

    abstract protected function getLineProvider() : LinesProvider;
}