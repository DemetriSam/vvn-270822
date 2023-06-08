<?php

namespace App\Services\Pages;

use App\Services\Tags\PageSeoTags;

abstract class PageBuilder
{
    protected $reader;
    protected $renderer;

    public function __construct(PageReader $reader, Renderer $renderer, $args = [])
    {
        $this->reader = $reader;
        $this->renderer = $renderer;

        $this->renderer->viewName = $this->getViewName();
        $this->renderer->addData(['name' => $this->reader->getName()]);

        $seoTags = $this->getPageSeoTags();
        $args = array_merge($args, ['name' => $this->reader->getName()]);
        $seoTags->initLineProvider($args);
        $this->seoTags = $seoTags;
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

    protected function createSeoTags()
    {
        $seoTags = $this->seoTags;
        $h1 = $seoTags->getH1();
        $title = $seoTags->getTitle();
        $description = $seoTags->getDescription();
        $this->renderer->addData(compact('title', 'h1', 'description'));
    }

    public function render()
    {
        $this->createSelection();
        $this->createSeoTags();
        return $this->renderer->render();
    }

    abstract public function getViewName();
    abstract public function getListingItems();
    abstract public function getFilters();
    abstract public function getPageSeoTags(): PageSeoTags;
}
