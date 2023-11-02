<?php

namespace App\Services\Pages;

use App\Models\PrCvet;
use App\Services\Tags\PageSeoTags;
use App\Services\Tags\SelectionSeoTags;
use App\Services\Tags\LinesProvider;
use App\Services\Tags\SelectionLinesProvider;


class ArticlePage extends PageBuilder
{
    private function getName()
    {
        return $this->reader->getName();
    }

    protected function init(): void
    {
        $this->renderer->viewName = 'article';
        $this->renderer->addData(['name' => $this->getName()]);
        $this->args = array_merge($this->args, ['name' => $this->getName()]);
    }

    protected function getLineProvider(): LinesProvider
    {
        return new SelectionLinesProvider($this->args);
    }

    public function getPageSeoTags(): PageSeoTags
    {
        $seoTags = new SelectionSeoTags();
        $seoTags->initLineProvider($this->args);
        return $seoTags;
    }
}
