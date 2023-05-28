<?php

namespace App\Services\Tags;

class SelectionLinesProvider implements LinesProvider
{
    public function __construct($args)
    {
        $this->name = $args['name'];
        $this->pageN = $args['pageN'];
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
            'pageN' => $this->pageN,
        ];

        return $map[$key];
    }
}
