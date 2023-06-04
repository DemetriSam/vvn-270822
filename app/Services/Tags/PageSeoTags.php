<?php

namespace App\Services\Tags;

use Exception;

abstract class PageSeoTags
{
    protected $args;

    public function initLineProvider($args)
    {
        $this->args = $args;
    }

    abstract protected function getLineProvider(): LinesProvider;
    abstract public function getH1();
    abstract public function getTitle();
    abstract public function getDescription();
}
