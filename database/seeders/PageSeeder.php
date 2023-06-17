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
                'name' => 'carpets',
                'type' => 'category',
                'title' => 'Ковровые покрытия',
                'params' => json_encode([
                    'listing' => 'category.products',
                    'filter' => [
                        'publicStatus' => 'true',
                        'groupBy' => 'color_id',
                    ],
                ]),
            ],
            [
                'slug' => 'cinovki',
                'name' => 'cinovki',
                'type' => 'category',
                'title' => 'Циновки',
                'params' => json_encode([
                    'listing' => 'category.products',
                    'filter' => [
                        'publicStatus' => 'true',
                        'groupBy' => 'color_id',
                    ],
                ]),
            ],
            [
                'slug' => 'kovrolin-poliamid',
                'type' => 'selection',
                'name' => 'poliamid',
                'title' => 'Ковролин из 100% полиамида',
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
                'title' => 'Ковролин из 100% полиэстера',
                'params' => json_encode([
                    'listing' => 'pr_cvets',
                    'filter' => [
                        'composition' => 'Полиэстер',
                        'publicStatus' => 'true',
                    ],
                ]),
            ],
        ];

        collect($pages)->each(fn ($page) => Page::firstOrCreate($page));
    }
}
