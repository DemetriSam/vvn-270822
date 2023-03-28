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
        $this->isWithDelete = true;
    }
    public function getDiff()
    {
        return optional(session('diff'))->reject(fn ($node) => empty($node));
    }

    public function pullDiff()
    {
        return session()->pull('diff');
    }

    public function setDataForUpdate($data, $supplier_id)
    {
        $this->update = $this->slugger
            ->setUniqueSlugs(collect($data), 'vendor_code', 'slug')
            ->map(fn ($row) => PrRoll::make($row));

        $this->supplier_id = $supplier_id;
        $this->current = PrRoll::where('supplier_id', $supplier_id)->get();
    }

    public function setDeleteOption(bool $is)
    {
        $this->isWithDelete = $is;
    }

    public function createInnerRepresentation()
    {
        $first = $this->current;
        $second = $this->update;
        $supplier_id = $this->supplier_id;

        session(['diff' => $this->diff($first, $second, $this->isWithDelete)]);
        session(['update' => $second]);
        session(['supplier_id' => $supplier_id]);
    }

    public function diff(Collection $first, Collection $second, $withDelete = true)
    {
        $f = $first->pluck('slug');
        $s = $second->pluck('slug');

        $slugs = $f->merge($s)->unique();

        return $slugs->map(function ($slug) use ($first, $second, $withDelete) {
            $value1 = $first->firstWhere('slug', $slug);
            $value2 = $second->firstWhere('slug', $slug);

            $q1 = $value1 ? floatval($value1->quantity_m2) : null;
            $q2 = $value2 ? floatval($value2->quantity_m2) : null;

            if (!$first->pluck('slug')->contains($slug)) {
                return [
                    'slug' => $slug,
                    'type' => 'added',
                    'value' => $value2,
                ];
            }

            if (!$second->pluck('slug')->contains($slug) && $withDelete) {
                return [
                    'slug' => $slug,
                    'type' => 'deleted',
                    'value' => $value1,
                ];
            }

            if ((string) $q1 === (string) $q2) {
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
