<?php

namespace App\Services\Pages;

use App\Models\PrCvet;
use App\Services\Tags\PageSeoTags;
use App\Services\Tags\SelectionSeoTags;

class SelectionPage extends PageBuilder
{
    public function getViewName()
    {
        return 'selection';
    }

    public function getFilters()
    {
        return new FilterLayers;
    }

    public function getListingItems()
    {
        return PrCvet::orderBy('pr_cvets.id');
    }

    public function getPageSeoTags(): PageSeoTags
    {
        return new SelectionSeoTags();
    }
}
