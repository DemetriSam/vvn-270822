<?php

namespace App\Services\Stockupdate;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Models\PrRoll;

class InnerRepresentation
{
    public function __construct(Slugger $slugger)
    {
        $this->slugger = $slugger;
    }
    public function getDiff()
    {
        return optional(session('diff'))->reject(fn($node) => empty($node));
    }

    public function pullDiff()
    {
        return session()->pull('diff');
    }

    public function setDataForUpdate($data, $supplier_id)
    {
        $this->update = $this->slugger
            ->setUniqueSlugs(collect($data), 'vendor_code', 'slug')
            ->map(fn($row) => PrRoll::make($row));

        $this->supplier_id = $supplier_id;
        $this->current = PrRoll::where('supplier_id', $supplier_id)->get();
    }

    public function createInnerRepresentation()
    {
        $first = $this->current;
        $second = $this->update;
        $supplier_id = $this->supplier_id;

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

            //unstrict comparsion for proper result for kind of 60 ? 60.00
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
