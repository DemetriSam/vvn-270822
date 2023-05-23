<?php

namespace App\Services\Tags;

interface LinesProvider
{
    public function getString(String $key);
}