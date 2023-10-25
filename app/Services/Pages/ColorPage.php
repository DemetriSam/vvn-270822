<?php

namespace App\Services\Pages;

use App\Services\Tags\PageSeoTags;
use App\Services\Tags\ColorSeoTags;

class ColorPage extends PageBuilder
{
    public function getPageSeoTags(): PageSeoTags
    {
        return new ColorSeoTags();
    }
}