<?php

namespace App\Services\Pages;

use App\Models\Category;
use App\Models\Color;
use App\Services\Tags\PageSeoTags;
use App\Services\Tags\CategorySeoTags;
use App\Services\Tags\LinesProvider;
use App\Services\Tags\CategoryLinesProvider;

class CategoryPage extends PageBuilder
{
    protected function init(): void
    {
        $this->renderer->viewName = 'catalog';
        $this->category = Category::firstWhere(['slug' => $this->reader->getName()]);
        $this->args = array_merge($this->args, ['category_id' => $this->category->id]);
        $this->createCategoryPage();
    }

    public function createCategoryPage()
    {
        $page = 1;
        $productsOnPage = 4;

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

        $this->renderer->addData(compact('category', 'grouped'));
    }

    public function getPageSeoTags(): PageSeoTags
    {
        $seoTags = new CategorySeoTags();
        $seoTags->initLineProvider($this->args);
        return $seoTags;
    }

    protected function getLineProvider() : LinesProvider
    {
        return new CategoryLinesProvider($this->args);
    }
}
