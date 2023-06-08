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

        $this->init($args);
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
        $this->build();
        return $this->renderer->render();
    }

    abstract public function getViewName();
    abstract public function getPageSeoTags(): PageSeoTags;
    abstract public function init(array $args);
    abstract public function build();
}
