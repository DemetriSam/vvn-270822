<?php

namespace App\Services\Stockupdate;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class InnerRepresentation
{
    private $innrep;

    public function getDiff()
    {
        return $this->innrep;
    }

    public function createInnerRepresentation(Collection $first, Collection $second)
    {
        $f = $first->pluck('slug');
        $s = $second->pluck('slug');
        $slugs = $f->merge($s);
        dump($slugs);

        $this->innrep = $slugs->map(function ($slug) use ($first, $second) {
            $value1 = $first->firstWhere('slug', $slug);
            $value2 = $second->firstWhere('slug', $slug);

            if (!$first->pluck('slug')->contains($slug)) {
                return [
                    'slug' => $slug,
                    'type' => 'added',
                    'value' => $value2,
                ];
            }

            if (!$second->pluck('slug')->contains($slug)) {
                return [
                    'slug' => $slug,
                    'type' => 'deleted',
                    'value' => $value1,
                ];
            }

            if ($value1 === $value2) {
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
