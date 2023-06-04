<?php

namespace App\Services\Pages;

interface PageReader
{
    public function getType();
    public function getSlug();
    public function getName();
    public function getFilters();
    public function getParams();
}
