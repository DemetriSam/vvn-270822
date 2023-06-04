<?php

namespace App\Services\Pages;

use App\Services\Tags\PageSeoTags;
use App\Services\Tags\CategorySeoTags;

class CategoryPage extends PageBuilder
{
    public function getPageSeoTags(): PageSeoTags
    {
        return new CategorySeoTags();
    }
}
