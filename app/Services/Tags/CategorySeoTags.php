<?php

namespace App\Services\Tags;

use App\Services\Tags\Traits\Description;
use App\Services\Tags\Traits\H1;
use App\Services\Tags\Traits\ListingTitle;

class CategorySeoTags extends PageSeoTags
{
    use ListingTitle;
    use Description;
    use H1;

    protected function getLineProvider(): LinesProvider
    {
        return new CategoryLinesProvider($this->args);
    }
}
