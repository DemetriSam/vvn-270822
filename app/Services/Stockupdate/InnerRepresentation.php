<?php

namespace App\Services\Stockupdate;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class InnerRepresentation
{
    public function getDiff()
    {
        return optional(session('diff'))->reject(fn ($node) => empty($node));
    }

    public function pullDiff()
    {
        return session()->pull('diff');
    }

    public function createInnerRepresentation(Collection $first, Collection $second, int $supplier_id)
    {
        session(['diff' => $this->diff($first, $second)]);
        session(['update' => $second]);
        session(['supplier_id' => $supplier_id]);
    }

    public function diff(Collection $first, Collection $second)
    {
        $f = $first->pluck('slug');
        $s = $second->pluck('slug');

        $slugs = $f->merge($s)->unique();

        return $slugs->map(function ($slug) use ($first, $second) {
            $value1 = $first->firstWhere('slug', $slug);
            $value2 = $second->firstWhere('slug', $slug);

            $q1 = $value1 ? $value1->quantity_m2 : null;
            $q2 = $value2 ? $value2->quantity_m2 : null;

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

            if ($q1 === $q2) {
                if ($q2 === null) {
                    return [];
                }
                return [
                    'slug' => $slug,
                    'type' => 'unchanged',
                    'value' => $value1,
                ];
            }

            return [
                'slug' => $slug,
                'type' => 'changed',
                'value_old' => $value1,
                'value' => $value2,
            ];
        });
    }
}
