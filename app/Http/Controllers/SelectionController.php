<?php

namespace App\Http\Controllers;

use App\Models\PrCvet;
use App\Services\Pages\FilterLayers;
use App\Services\Tags\SelectionSeoTags;
use Illuminate\Http\Request;

class SelectionController extends Controller
{
    public function kovrolinPoliamid(Request $request, SelectionSeoTags $seoTags, FilterLayers $filterLayers)
    {
        $filter = [
            'composition' => 'Нейлон',
            'publicStatus' => 'true',
        ];

        $products = PrCvet::orderBy('pr_cvets.id');
        $filterLayers->setBase($products);
        $filterLayers->setFilter($filter);

        $products = $filterLayers->getQuery()->paginate(12);

        $name = 'poliamid';
        $seoTags->initLineProvider(['name' => $name, 'pageN' => $request->page]);

        $h1 = $seoTags->getH1();
        $title = $seoTags->getTitle();
        $description = $seoTags->getDescription();

        return view('selection', compact('products', 'title', 'h1', 'description', 'name'));
    }
    public function kovrolinPoliester(Request $request, SelectionSeoTags $seoTags, FilterLayers $filterLayers)
    {
        $filter = [
            'composition' => 'Полиэстер',
            'publicStatus' => 'true',
        ];

        $products = PrCvet::orderBy('pr_cvets.id');
        $filterLayers->setBase($products);
        $filterLayers->setFilter($filter);

        $products = $filterLayers->getQuery()->paginate(12);

        $name = 'poliester';
        $seoTags->initLineProvider(['name' => $name, 'pageN' => $request->page]);

        $h1 = $seoTags->getH1();
        $title = $seoTags->getTitle();
        $description = $seoTags->getDescription();

        return view('selection', compact('products', 'title', 'h1', 'description', 'name'));
    }
}
