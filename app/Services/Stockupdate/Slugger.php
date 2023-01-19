<?php

namespace App\Services\Stockupdate;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Slugger
{
    public function setUniqueSlugs(Collection $collection, $baseField, $slugField) {

        return $collection->map(function($row) use($collection, $baseField, $slugField) {
            if(!isset($row[$baseField])) {
                return $row;
            }

            $slug = Str::slug($row[$baseField]);
            $i = 1;
            while ($collection->pluck('slug')->contains($slug)) {
                $slug = implode('-', [$slug, $i]);
                $i++;
            }
            $row['slug'] = $slug;
            return $row;
        });
    }
}