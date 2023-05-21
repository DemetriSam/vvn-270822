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

        $products = $category->products->filter(fn ($product) => $product->isPublished())->sort();

        $grouped = $products
            ->groupBy('color_id')
            ->map(function ($group, $id) use ($page, $productsOnPage) {
                $result = [
                    'sort' => $id,
                    'color' => $id ? Color::find($id) : null,
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
        $title = 'Ковровые покрытия и циновки в наличии на складе в Москве';
        $productsOnPage = 12;
        $page = 1;

        try {
            $carpetsCat = Category::firstWhere('slug', 'carpets');
        } catch (\Throwable $th) {
            return view('index', ['carpets' => false, 'cinovki' => false]);
        }

        $products = $carpetsCat?->products->filter(fn ($product) => $product->isPublished())->sort();

        $carpets = [
            'title' => $carpetsCat?->name,
            'products' => $products?->forPage($page, $productsOnPage),
            'route' => [],
            'linktext' => '',
        ];

        if ($products?->count() > $productsOnPage) {
            $carpets = array_merge($carpets, [
                'route' => ['catalog', ['category' => 'carpets']],
                'linktext' => 'Смотреть все ковровые покрытия',
            ]);
        }

        try {
            $cinovkiCat = Category::firstWhere('slug', 'cinovki');
        } catch (\Throwable $th) {
            return view('index', ['carpets' => false, 'cinovki' => false]);
        }

        $products = $cinovkiCat?->products->filter(fn ($product) => $product->isPublished())->sort();

        $cinovki = [
            'title' => $cinovkiCat?->name,
            'products' => $products->forPage($page, $productsOnPage),
            'route' => [],
            'linktext' => '',
        ];

        if ($products?->count() > $productsOnPage) {
            $cinovki = array_merge($cinovki, [
                'route' => ['catalog', ['category' => 'cinovki']],
                'linktext' => 'Смотреть все циновки',
            ]);
        }

        return view('index', compact('title', 'carpets', 'cinovki'));
    }

    /**
     * Страница избранного
     *
     * @return \Illuminate\View\View
     */
    public function favorites()
    {
        $title = 'Избранное';
        if (!isset($_COOKIE['favorites_cookie']) or !$_COOKIE['favorites_cookie']) {
            $products = collect([]);
            return view('favorites', compact('title', 'products'));
        }
        $cookie = $_COOKIE['favorites_cookie'];
        $favorites_ids = explode(',', $cookie);
        $products = collect($favorites_ids)->map(fn ($id) => PrCvet::find($id));
        return view('favorites', compact('title', 'products'));
    }

    public function color(Category $category, Color $color)
    {
        $products = $category->products()
            ->where('color_id', $color->id)
            ->where('pr_cvets.published', 'true')
            ->paginate(12);

        $description = '';
        $title = $category->name . '. Цвет: ' . $color->name;
        return view('color', compact('title', 'color', 'products', 'description'));
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
