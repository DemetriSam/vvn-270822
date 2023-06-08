<?php

namespace App\Services\Pages;

use App\Models\Category;
use App\Models\Color;
use App\Services\Tags\PageSeoTags;
use App\Services\Tags\CategorySeoTags;

class CategoryPage extends PageBuilder
{

    public function init(array $args)
    {
        $this->name = $this->reader->getName();
        $this->category = Category::firstWhere(['slug' => $this->name]);
        $seoTags = $this->getPageSeoTags();
        $args = array_merge($args, [
            'name' => $this->reader->getName(),
            'category_id' => $this->category->id,
        ]);
        $seoTags->initLineProvider($args);
        $this->seoTags = $seoTags;
    }

    public function getViewName()
    {
        return 'catalog';
    }

    public function getPageSeoTags(): PageSeoTags
    {
        return new CategorySeoTags();
    }

    public function build()
    {
        $this->createSeoTags();
        $this->buildListing();
    }

    public function buildListing()
    {
        $page = 1;
        $productsOnPage = 4;

        $name = $this->name;
        $category = $this->category;
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

        $this->renderer->addData(compact('category', 'grouped', 'productsOnPage'));
    }
}
