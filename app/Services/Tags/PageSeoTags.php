<?php

namespace App\Services\Tags;

use Exception;

abstract class PageSeoTags
{
    protected $providerFactory;
    protected $provider;

    public function __construct(ProviderFactory $factory)
    {
        $this->providerFactory = $factory;
    }

    public function initLineProvider($args)
    {
        $this->provider = $this
            ->providerFactory
            ->getProvider($this->getPageType(), $args);
    }

    protected function getLineProvider() : LinesProvider
    {
        try {
            return $this->provider;
        } catch (Exception $e) {
            echo $e->getMessage() . ' Did you init Line Provider?';
        }
    }

    abstract protected function getPageType();
    abstract public function getH1();
    abstract public function getTitle();
    abstract public function getDescription();
}