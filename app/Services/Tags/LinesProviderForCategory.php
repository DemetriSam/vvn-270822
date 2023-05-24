<?php

namespace App\Services\Tags;

use App\Models\Category;

class LinesProviderForCategory implements LinesProvider
{
    public function __construct($id)
    {
        $this->category = Category::find($id);
    }

    public function getString(String $key)
    {
        $map = [
            'name' => $this->category->name,
            'description' => $this->category->description,
            'postfix' => __('public.sitename'),
        ];

        return __($map[$key]);
    }
}