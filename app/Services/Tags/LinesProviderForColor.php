<?php

namespace App\Services\Tags;

use App\Models\Category;
use App\Models\Color;

class LinesProviderForColor implements LinesProvider
{
    public function __construct($categoryId, $colorId)
    {
        $this->category = Category::find($categoryId);
        $this->color = Color::find($colorId);
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
        ];

        return __($map[$key]);
    }
}
