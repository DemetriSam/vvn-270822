<?php

namespace App\Services\Tags;

use App\Models\Page;

class SelectionLinesProvider implements LinesProvider
{
    public function __construct($args)
    {
        $this->name = $args['name'];
        $this->pageN = $args['pageN'];
        $this->pageRecord = Page::firstWhere('name', $this->name);
    }

    public function getString(String $key)
    {
        $map = [
            'name' => $this->pageRecord->title,
            'description' => $this->pageRecord->description,
            'text-content' => $this->pageRecord->{'text-content'},
            'postfix' => __('public.sitename'),
            'pageN' => $this->pageN,
        ];

        return $map[$key];
    }
}
