<?php

namespace App\Services\Pages;

use App\Models\Page;

class EloqPageReader implements PageReader
{
    public function read(Page $page)
    {
        $this->page = $page;
    }

    public function getType()
    {
        return $this->page->type;
    }

    public function getSlug()
    {
        return $this->page->slug;
    }

    public function getName()
    {
        return $this->page->name;
    }

    public function getFilters()
    {
    }

    public function getParams(): array
    {
        $params = $this->page->params;
        $params = is_array($params) ? $params : json_decode($params, true);
        return $params ?? [];
    }

    public function getPublished(): string
    {
        return $this->page->published;
    }
}
