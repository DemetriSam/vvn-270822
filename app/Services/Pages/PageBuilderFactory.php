<?php

namespace App\Services\Pages;

use App\Models\Page;
use Exception;

class PageBuilderFactory
{
    protected $args = [];

    public function __construct(EloqPageReader $reader, LaravelRenderer $renderer)
    {
        $this->reader = $reader;
        $this->renderer = $renderer;
    }

    public function addData($args)
    {
        $this->args = array_merge($this->args, $args);
    }

    public function getPageBuilder(Page $page)
    {
        $reader = $this->reader;
        $reader->read($page);
        $type = $reader->getType();
        switch ($type) {
            case 'product':
                return new ProductPage($reader, $this->renderer, $this->args);
            case 'category':
                return new CategoryPage($reader, $this->renderer, $this->args);
            case 'color':
                return new ColorPage($reader, $this->renderer, $this->args);
            case 'selection':
                return new SelectionPage($reader, $this->renderer, $this->args);
            default:
                throw new Exception('Such Page does not exist');
        }
    }
}
