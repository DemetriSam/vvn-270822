<?php

namespace App\Services\Tags;

use App\Services\Tags\Traits\Description;
use App\Services\Tags\Traits\H1;
use App\Services\Tags\Traits\ListingTitle;

class ColorSeoTags extends PageSeoTags
{
    use ListingTitle;
    use Description;
    use H1;
    
    const PAGE_TYPE = 'color';

    protected function getPageType()
    {
        return self::PAGE_TYPE;
    }
}