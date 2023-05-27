<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PrCvet;
use App\Services\Tags\Description;
use App\Services\Tags\H1;
use App\Services\Tags\Title;
use Illuminate\Http\Request;

class SelectionController extends Controller
{
    public function kovrolinPoliamid(H1 $h1Prov, Title $titleProv, Description $descProv)
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
            $title = $titleProv->getTag('selection', ['name' => $name]);
            $h1 = $h1Prov->getTag('selection', ['name' => $name]);
            $description = $descProv->getTag('selection', ['name' => $name]);

        return view('selection', compact('products', 'title', 'h1', 'description', 'name'));
    }
    public function kovrolinPoliester(H1 $h1Prov, Title $titleProv, Description $descProv)
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
        $title = $titleProv->getTag('selection', ['name' => $name]);
        $h1 = $h1Prov->getTag('selection', ['name' => $name]);
        $description = $descProv->getTag('selection', ['name' => $name]);

        return view('selection', compact('products', 'title', 'h1', 'description', 'name'));
    }
}
