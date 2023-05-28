<?php

namespace App\Services\Tags\Traits;

use App\Services\Tags\LinesProvider;

trait H1
{
    public function getH1()
    {
        $provider = $this->getLineProvider();
        return $provider->getString('name');
    }

    abstract protected function getLineProvider() : LinesProvider;
}