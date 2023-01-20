<?php

namespace App\Services\Stockupdate;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Slugger
{
    public function setUniqueSlugs(Collection $collection, $baseField, $slugField)
    {
        $result = collect();

        $collection->sortBy('vendor_code')->each(function ($row) use ($result, $baseField, $slugField) {
            if (!isset($row[$baseField])) {
                return false;
            }

            $slug = Str::slug($row[$baseField]);
            $i = 1;
            while ($result->pluck($slugField)->contains($slug)) {
                $slug = implode('-', [$slug, $i]);
                $i++;
            }
            $row[$slugField] = $slug;
            $result->push($row);
        });

        return $result;
    }
}
