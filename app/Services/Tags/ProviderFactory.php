<?php

namespace App\Services\Tags;

interface ProviderFactory
{
    public function getProvider(String $case, Array $args) : LinesProvider;
}