<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PrCvet;
use Illuminate\Http\Request;

class SelectionController extends Controller
{
    public function kovrolinPoliamid()
    {
        $products = PrCvet::orderBy('pr_cvets.id')
            ->join('pr_collections', 'pr_collections.id', '=', 'pr_cvets.pr_collection_id')
            ->join('pr_collection_property_value', 'pr_collections.id', '=', 'pr_collection_property_value.pr_collection_id')
            ->join('property_values', 'property_values.id', '=', 'pr_collection_property_value.property_value_id')
            ->where('value', '=', 'Нейлон')
            ->where('pr_cvets.published', '=', 'true')
            ->paginate(12);

        $title = 'Ковролин из 100% полиамида';
        $description = 'Ковролин из материала известного как нейлон, полиамид или иначе олефин. Считается лучшим материалом из искусственных для изготовления ковровых покрытий';

        return view('selection', compact('products', 'title', 'description'));
    }
}
