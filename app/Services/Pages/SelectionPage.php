<?php

namespace App\Services\Pages;

use App\Models\PrCvet;
use App\Services\Tags\PageSeoTags;
use App\Services\Tags\SelectionSeoTags;
use App\Services\Tags\LinesProvider;
use App\Services\Tags\SelectionLinesProvider;


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
        $this->args = array_merge($this->args, ['name' => $this->getName()]);
        $this->createSelection();
    }

    protected function getLineProvider() : LinesProvider
    {
        return new SelectionLinesProvider($this->args);
    }

    private function createSelection()
    {
        $params = $this->reader->getParams();
        if (isset($params['filter'])) {
            $filter = $params['filter'];
        } else {
            $filter = [
                'publicStatus' => 'true',
            ];
        }

        $filterLayers = new FilterLayers;
        $filterLayers->setBase(PrCvet::orderBy('pr_cvets.id'));
        $filterLayers->setFilter($filter);
        $products = $filterLayers->getQuery()->paginate(12, '*', 'pageN');

        $this->renderer->addData(['products' => $products]);
    }

    public function getPageSeoTags(): PageSeoTags
    {
        $seoTags = new SelectionSeoTags();
        $seoTags->initLineProvider($this->args);
        return $seoTags;
    }
}
