<?php

namespace App\Services\Pages;

class LaravelRenderer implements Renderer
{
    private $data = [];
    public $viewName = 'add_view_name';

    public function addData($incomingData): void
    {
        $data = $this->data;
        $this->data = array_merge($data, $incomingData);
    }

    public function render()
    {
        $view = $this->viewName;
        $data = $this->data;
        return view($view, $data);
    }
}
