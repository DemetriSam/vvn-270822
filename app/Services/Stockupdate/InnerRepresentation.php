<?php

namespace App\Services\Stockupdate;

use Illuminate\Support\Str;

class InnerRepresentation
{
    public function getDiff()
    {

    }

    public function createInnerRepresentaion(Collection $first, Collection $second)
    {
        $slugs = $first->merge($second)->pluck('slug')->unique()->values()->sort();

        return $slugs->map(function($slug) use ($first, $second) {
            $value1 = $first->firstWhere('slug', $slug);
            $value2 = $second->firstWhere('slug', $slug);

            if(!$first->pluck('slug')->contains($slug)) {
                return [
                    'slug' => $slug,
                    'type' => 'added',
                    'value' => $value2,
                ];
            }

            if(!$second->pluck('slug')->contains($slug)) {
                return [
                    'slug' => $slug,
                    'type' => 'deleted',
                    'value' => $value1,
                ];
            }

            if($value1 === $value2) {
                return [
                    'slug' => $slug,
                    'type' => 'unchanged',
                    'value' => $value1,
                ];
            }

            return [
                'slug' => $slug,
                'type' => 'changed',
                'value1' => $value1,
                'value2' => $value2,
            ];

        });
    }
}