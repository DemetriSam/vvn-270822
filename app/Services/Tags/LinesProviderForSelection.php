<?php

namespace App\Services\Tags;

use App\Models\Category;
use App\Models\Color;

class LinesProviderForSelection implements LinesProvider
{
    public function __construct($selectionName)
    {
        $this->name = $selectionName;
    }

    public function getString(String $key)
    {
        $map = [
            'name' => __(implode('.', [
                'public',
                'selections',
                $this->name,
                'h1'
            ])),
            'description' => __(implode('.', [
                'public',
                'selections',
                $this->name,
                'description',
            ])),
            'postfix' => __('public.sitename'),
        ];

        return $map[$key];
    }
}
