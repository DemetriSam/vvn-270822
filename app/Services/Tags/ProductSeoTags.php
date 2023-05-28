<?php

namespace App\Services\Tags;

use App\Services\Tags\Traits\Description;
use App\Services\Tags\Traits\ProductH1;
use App\Services\Tags\Traits\ProductTitle;

class ProductSeoTags extends PageSeoTags
{
        use ProductTitle;
        use Description;
        use ProductH1;

    const PAGE_TYPE = 'product';

    protected function getPageType()
    {
        return self::PAGE_TYPE;
    }
}