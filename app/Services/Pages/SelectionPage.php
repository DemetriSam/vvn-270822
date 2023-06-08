<?php

namespace App\Services\Pages;

use App\Models\PrCvet;
use App\Services\Tags\PageSeoTags;
use App\Services\Tags\SelectionSeoTags;

class SelectionPage extends PageBuilder
{

    public function init(array $args)
    {
        $seoTags = $this->getPageSeoTags();
        $args = array_merge($args, ['name' => $this->reader->getName()]);
        $seoTags->initLineProvider($args);
        $this->seoTags = $seoTags;
    }

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


    protected function createSelection()
    {
        $params = $this->reader->getParams();
        if (isset($params['filter'])) {
            $filter = $params['filter'];
        } else {
            $filter = [
                'publicStatus' => 'true',
            ];
        }

        $filterLayers = $this->getFilters();
        $filterLayers->setBase($this->getListingItems());
        $filterLayers->setFilter($filter);
        $products = $filterLayers->getQuery()->paginate(12);

        $this->renderer->addData(['products' => $products]);
    }

    public function build()
    {
        $this->createSelection();
        $this->createSeoTags();
    }
}
