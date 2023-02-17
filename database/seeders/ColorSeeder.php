<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name' => 'Белый',
                'slug' => 'white',
                'color_hash' => 'put_hash_here',
            ],
            [
                'name' => 'Бежевый',
                'slug' => 'beige',
                'color_hash' => 'put_hash_here',
            ],
            [
                'name' => 'Зеленый',
                'slug' => 'green',
                'color_hash' => 'put_hash_here',
            ],
            [
                'name' => 'Коричневый',
                'slug' => 'brown',
                'color_hash' => 'put_hash_here',
            ],
            [
                'name' => 'Красный',
                'slug' => 'red',
                'color_hash' => 'put_hash_here',
            ],
            [
                'name' => 'Оранжевый',
                'slug' => 'orange',
                'color_hash' => 'put_hash_here',
            ],
            [
                'name' => 'Серый',
                'slug' => 'grey',
                'color_hash' => 'put_hash_here',
            ],
            [
                'name' => 'Синий',
                'slug' => 'blue',
                'color_hash' => 'put_hash_here',
            ],
            [
                'name' => 'Сиреневый',
                'slug' => 'lilac',
                'color_hash' => 'put_hash_here',
            ],
            [
                'name' => 'Черный',
                'slug' => 'black',
                'color_hash' => 'put_hash_here',
            ],
        ];

        $colorsIds = collect($colors)->map(
            fn ($color) => \App\Models\Color::firstOrCreate($color)->id
        );

        Category::firstOrCreate([
            'name' => 'Ковровые покрытия',
            'slug' => 'carpets',
        ])->colors()->attach($colorsIds);

        Category::firstOrCreate([
            'name' => 'Циновки',
            'slug' => 'cinovki',
        ])->colors()->attach($colorsIds);
    }
}
