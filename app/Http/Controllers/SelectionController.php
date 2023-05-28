<?php

namespace App\Http\Controllers;

use App\Models\PrCvet;
use App\Services\Tags\SelectionSeoTags;
use Illuminate\Http\Request;

class SelectionController extends Controller
{
    public function kovrolinPoliamid(Request $request, SelectionSeoTags $seoTags)
    {
        $products = PrCvet::orderBy('pr_cvets.id')
            ->join('pr_collections', 'pr_collections.id', '=', 'pr_cvets.pr_collection_id')
            ->join('pr_collection_property_value', 'pr_collections.id', '=', 'pr_collection_property_value.pr_collection_id')
            ->join('property_values', 'property_values.id', '=', 'pr_collection_property_value.property_value_id')
            ->where('value', '=', 'Нейлон')
            ->where('pr_cvets.published', '=', 'true')
            ->select('pr_cvets.*')
            ->distinct()
            ->paginate(12);

            $name = 'poliamid';
            $seoTags->initLineProvider(['name' => $name, 'pageN' => $request->page]);

            $h1 = $seoTags->getH1();
            $title = $seoTags->getTitle();
            $description = $seoTags->getDescription();

        return view('selection', compact('products', 'title', 'h1', 'description', 'name'));
    }
    public function kovrolinPoliester(Request $request, SelectionSeoTags $seoTags)
    {
        $products = PrCvet::orderBy('pr_cvets.id')
            ->join('pr_collections', 'pr_collections.id', '=', 'pr_cvets.pr_collection_id')
            ->join('pr_collection_property_value', 'pr_collections.id', '=', 'pr_collection_property_value.pr_collection_id')
            ->join('property_values', 'property_values.id', '=', 'pr_collection_property_value.property_value_id')
            ->where('value', '=', 'Полиэстер')
            ->where('pr_cvets.published', '=', 'true')
            ->select('pr_cvets.*')
            ->distinct()
            ->paginate(12);

        $name = 'poliester';
        $seoTags->initLineProvider(['name' => $name, 'pageN' => $request->page]);

        $h1 = $seoTags->getH1();
        $title = $seoTags->getTitle();
        $description = $seoTags->getDescription();

        return view('selection', compact('products', 'title', 'h1', 'description', 'name'));
    }
}
