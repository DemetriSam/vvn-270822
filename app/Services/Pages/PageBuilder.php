<?php

namespace App\Services\Pages;

use App\Services\Tags\PageSeoTags;
use App\Services\Tags\LinesProvider;

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
        $this->renderer->addData(['text_content' => $this->getLineProvider()->getString('text-content')]);
        return $this->renderer->render();
    }

    abstract protected function getLineProvider() : LinesProvider;
    abstract public function getPageSeoTags(): PageSeoTags;
    abstract protected function init(): void;
}
