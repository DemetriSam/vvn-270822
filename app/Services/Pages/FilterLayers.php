<?php

namespace App\Services\Pages;

use App\Models\Category;
use App\Models\PrCvet;

class FilterLayers
{
    protected $base;

    public function setBase($query)
    {
        $this->base = $query;
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function getQuery()
    {
        $filter = $this->filter;
        $query = $this->base;

        $query = isset($filter['publicStatus']) && $filter['publicStatus'] ?
            $query->where('pr_cvets.published', $filter['publicStatus']) :
            $query;

        $query = isset($filter['color_id']) && $filter['color_id'] ?
            $query->where('color_id', $filter['color_id']) :
            $query;

        $query = isset($filter['pr_collection_id']) && $filter['pr_collection_id'] ?
            $query->where('pr_cvets.pr_collection_id', $filter['pr_collection_id']) :
            $query;

        if (isset($filter['category']) && $filter['category']) {
            $categoryId = Category::firstWhere('slug', $filter['category'])->id;
            $query = $query
                ->join('pr_collections AS category_pr_collections', 'pr_cvets.pr_collection_id', '=', 'category_pr_collections.id')
                ->where('category_pr_collections.category_id', '=', $categoryId)->select('pr_cvets.*');
        }

        if (isset($filter['has_images'])) {
            if ($filter['has_images'] === 'true') {
                $query->join('media', function ($join) {
                    $join->on('pr_cvets.id', '=', 'media.model_id')
                        ->where('model_type', PrCvet::class)
                        ->whereNotNull('media.name');
                })->select('pr_cvets.*');
            } elseif ($filter['has_images'] === 'false') {
                $query->leftJoin('media', function ($join) {
                    $join->on('pr_cvets.id', '=', 'media.model_id')
                        ->where('model_type', PrCvet::class);
                })->whereNull('media.id')->select('pr_cvets.*');
            }
        }

        if (isset($filter['composition'])) {
            $composition = $filter['composition'];
            $query = $query
                ->join('pr_collections AS composition_pr_collections', 'composition_pr_collections.id', '=', 'pr_cvets.pr_collection_id')
                ->join('pr_collection_property_value', 'composition_pr_collections.id', '=', 'pr_collection_property_value.pr_collection_id')
                ->join('property_values', 'property_values.id', '=', 'pr_collection_property_value.property_value_id')
                ->where('value', '=', $composition)
                ->select('pr_cvets.*');
        }

        if (isset($filter['width'])) {
            $width = $filter['width'];
            $query = $query
                ->join('pr_collections AS width_pr_collections', 'width_pr_collections.id', '=', 'pr_cvets.pr_collection_id')
                ->join('pr_collection_property_value', 'width_pr_collections.id', '=', 'pr_collection_property_value.pr_collection_id')
                ->join('property_values', 'property_values.id', '=', 'pr_collection_property_value.property_value_id')
                ->where('value', '=', $width)
                ->select('pr_cvets.*');
        }

        if (isset($filter['like']) && isset($filter['search_in'])) {
            $haystack = $filter['search_in'];
            $needle = $filter['like'];
            $query = $query
                ->where($haystack, 'like', '%' . $needle . '%')
                ->orWhere($haystack, 'like', '%' . strtoupper($needle) . '%');
        }

        $query = isset($filter['has_cvet']) && $filter['has_cvet'] === 'true' ?
            $query->whereNotNull('pr_cvet_id') :
            $query;

        $query = isset($filter['has_cvet']) && $filter['has_cvet'] === 'false' ?
            $query->whereNull('pr_cvet_id') :
            $query;

        $query = isset($filter['supplier_id']) && $filter['supplier_id'] ?
            $query->where('supplier_id', $filter['supplier_id']) :
            $query;

        return $query;
    }
}
