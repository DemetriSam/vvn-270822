<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'slug' => 'carpets',
                'type' => 'category',
                'name' => 'carpets',
                'params' => json_encode([
                    'listing' => 'category.products',
                    'filter' => [
                        'publicStatus' => 'true',
                    ],
                    'groupBy' => 'color_id',
                ]),
            ],
            [
                'slug' => 'cinovki',
                'type' => 'category',
                'name' => 'cinovki',
                'params' => json_encode([
                    'listing' => 'category.products',
                    'filter' => [
                        'publicStatus' => 'true',
                    ],
                    'groupBy' => 'color_id',
                ]),
            ],
            [
                'slug' => 'kovrolin-poliamid',
                'type' => 'selection',
                'name' => 'poliamid',
                'params' => json_encode([
                    'listing' => 'pr_cvets',
                    'filter' => [
                        'composition' => 'Нейлон',
                        'publicStatus' => 'true',
                    ],
                ]),
            ],
            [
                'slug' => 'kovrolin-poliester',
                'type' => 'selection',
                'name' => 'poliester',
                'params' => json_encode([
                    'listing' => 'pr_cvets',
                    'filter' => [
                        'composition' => 'Нейлон',
                        'publicStatus' => 'true',
                    ],
                ]),
            ],
        ];

        collect($pages)->each(fn ($page) => Page::firstWhere('slug', $page['slug']) ? null : Page::create($page));
    }
}
