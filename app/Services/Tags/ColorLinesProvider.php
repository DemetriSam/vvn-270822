<?php

namespace App\Services\Tags;

use App\Models\Category;
use App\Models\Color;

class ColorLinesProvider implements LinesProvider
{
    public function __construct($args)
    {
        $this->category = Category::find($args['category_id']);
        $this->color = Color::find($args['color_id']);
        $this->pageN = $args['pageN'];
    }

    public function getString(String $key)
    {
        $map = [
            'name' => __(implode('.', [
                'public',
                'colors',
                $this->category->slug,
                $this->color->slug,
                'title'
            ])),
            'description' => __(implode('.', [
                'public',
                'colors',
                $this->category->slug,
                $this->color->slug,
                'description',
            ])),
            'postfix' => __('public.sitename'),
            'pageN' => $this->pageN,
        ];

        return $map[$key];
    }
}
