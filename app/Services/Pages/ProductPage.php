<?php

namespace App\Services\Pages;

use App\Services\Tags\PageSeoTags;
use App\Services\Tags\ProductSeoTags;

class ProductPage extends PageBuilder
{
    public function getPageSeoTags(): PageSeoTags
    {
        return new ProductSeoTags();
    }
}
