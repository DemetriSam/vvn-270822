<?php

namespace App\Services\Pages;

interface Renderer
{
    public function addData($data): void;
    public function render();
}
