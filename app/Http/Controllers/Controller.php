<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\PrCollection;
use App\Models\PrCvet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * Каталог с ковровыми покрытиями
     *
     * @return \Illuminate\View\View
     */
    public function catalog(Category $category)
    {
        $page = 1;
        $productsOnPage = 4;

        $products = $category->products;
        $grouped = $products
            ->groupBy('color_id')
            ->map(function ($group, $id) use ($page, $productsOnPage) {
                $result = [
                    'sort' => $id,
                    'color' => Color::find($id),
                    'products' => $group->forPage($page, $productsOnPage),
                    'thereAreMore' => $group->count() > $productsOnPage,
                    'moreOnes' => $group->count() - $productsOnPage,
                ];

                if (!$id) {
                    $result = array_merge($result, ['sort' => 100, 'color' => 'Сложный тон']);
                }
                return $result;
            })->sortBy('sort');

        return view('catalog', compact('category', 'grouped', 'productsOnPage'));
    }

    /**
     * Главная страница
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $productsOnPage = 12;
        $page = 1;

        $carpetsCat = Category::firstWhere('slug', 'carpets');

        $carpets = [
            'title' => $carpetsCat->name,
            'products' => $carpetsCat->products->forPage($page, $productsOnPage),
            'route' => ['catalog', ['category' => 'carpets']],
            'linktext' => 'Смотреть все ковровые покрытия',
        ];

        if ($carpetsCat->products->count() > $productsOnPage) {
            $carpets = array_merge($carpets, [
                'route' => ['catalog', ['category' => 'carpets']],
                'linktext' => 'Смотреть все ковровые покрытия',
            ]);
        }

        $cinovkiCat = Category::firstWhere('slug', 'cinovki');

        $cinovki = [
            'title' => $cinovkiCat->name,
            'products' => $cinovkiCat->products->forPage($page, $productsOnPage),
        ];

        if ($carpetsCat->products->count() > $productsOnPage) {
            $cinovki = array_merge($cinovki, [
                'route' => ['catalog', ['category' => 'cinovki']],
                'linktext' => 'Смотреть все циновки',
            ]);
        }

        return view('index', compact('carpets', 'cinovki'));
    }

    /**
     * Страница избранного
     *
     * @return \Illuminate\View\View
     */
    public function favorites()
    {
        $cookie = $_COOKIE['favorites_cookie'];
        if (!$cookie) {
            return view('favorites', ['products' => collect([])]);
        }
        $favorites_ids = explode(',', $cookie);
        $products = collect($favorites_ids)->map(fn ($id) => PrCvet::find($id));
        return view('favorites', ['products' => $products]);
    }

    public function color(Category $category, Color $color)
    {
        $products = $category->products()->where('color_id', $color->id)->paginate(12);
        return view('color', compact('color', 'products'));
    }

    public function whatsapp()
    {
        return view('index');
    }
    public function hello()
    {
        return view('index');
    }
}
