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
        $this->args = $args;
        $this->init();
    }

    public function render()
    {
        $seoTags = $this->getPageSeoTags();
        $h1 = $seoTags->getH1();
        $title = $seoTags->getTitle();
        $description = $seoTags->getDescription();
        $this->renderer->addData(compact('title', 'h1', 'description'));

        return $this->renderer->render();
    }

    abstract public function getPageSeoTags(): PageSeoTags;
    abstract protected function init(): void;
}
