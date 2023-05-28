<?php

namespace App\Services\Tags;

use App\Models\Category;

class CategoryLinesProvider implements LinesProvider
{
    public function __construct($args)
    {
        $this->category = Category::find($args['category_id']);
        $this->pageN = isset($args['pageN']) ? $args['pageN'] : NULL;
    }

    public function getString(String $key)
    {
        $map = [
            'name' => $this->category->name,
            'description' => $this->category->description,
            'postfix' => __('public.sitename'),
            'pageN' => $this->pageN,  
        ];

        return $map[$key];
    }
}