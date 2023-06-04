<?php

namespace App\Services\Pages;

use App\Models\PrCvet;
use App\Services\Tags\PageSeoTags;
use App\Services\Tags\SelectionSeoTags;

class SelectionPage extends PageBuilder
{
    private function getName()
    {
        return $this->reader->getName();
    }

    protected function init(): void
    {
        $this->renderer->viewName = 'selection';
        $this->renderer->addData(['name' => $this->getName()]);
        $this->createSelection();
    }

    private function createSelection()
    {
        $filter = $this->reader->getParams()['filter'];
        $filterLayers = new FilterLayers;
        $filterLayers->setBase(PrCvet::orderBy('pr_cvets.id'));
        $filterLayers->setFilter($filter);

        $products = $filterLayers->getQuery()->paginate(12);
        $this->renderer->addData(['products' => $products]);
    }

    public function getPageSeoTags(): PageSeoTags
    {
        $seoTags = new SelectionSeoTags();
        $args = array_merge($this->args, ['name' => $this->getName()]);
        $seoTags->initLineProvider($args);
        return $seoTags;
    }
}
