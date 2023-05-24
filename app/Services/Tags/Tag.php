<?php

namespace App\Services\Tags;

abstract class Tag
{
    public function __construct(ProviderFactory $factory)
    {
        $this->providerFactory = $factory;
    }
    
    abstract public function getTag(String $case, Array $args);
}