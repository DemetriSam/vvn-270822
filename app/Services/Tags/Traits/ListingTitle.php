<?php

namespace App\Services\Tags\Traits;

use App\Services\Tags\LinesProvider;

trait ListingTitle
{
    public function getTitle()
    {
        $provider = $this->getLineProvider();
        $name = $provider->getString('name');
        $postfix = $provider->getString('postfix');
        $segments = [$name, $postfix];
        if($provider->getString('pageN')) {
            $segments[] = 'стр. ' . $provider->getString('pageN');
        }

        return implode(' — ', $segments);
    }

    abstract protected function getLineProvider() : LinesProvider;
}