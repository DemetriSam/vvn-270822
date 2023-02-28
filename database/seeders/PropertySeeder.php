<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PrCollection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyValue;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $width = Property::firstOrCreate([
            'name' => 'Ширина рулона',
            'machine_name' => 'width',
        ]);
        $composition = Property::firstOrCreate([
            'name' => 'Состав',
            'machine_name' => 'composition',
        ]);

        Category::firstOrCreate([
            'name' => 'Ковровые покрытия',
            'slug' => 'carpets',
        ])->properties()->attach([$width->id, $composition->id]);

        Category::firstOrCreate([
            'name' => 'Циновки',
            'slug' => 'cinovki',
        ])->properties()->attach([$width->id, $composition->id]);

        PrCollection::firstOrCreate([
            'name' => 'default',
            'default_price' => 0.5,
            'category_id' => 1,
        ]);

        $values = [
            'width' => [
                ['value' => '4 м'],
                ['value' => '3,66 м'],
            ],
            'composition' => [
                ['value' => 'Шерсть'],
                ['value' => 'Нейлон'],
                ['value' => 'Сизаль'],
                ['value' => 'Полипропилен'],
            ],
        ];

        foreach ($values['width'] as $value) {
            $width->values()->firstOrCreate($value);
        }
        foreach ($values['composition'] as $value) {
            $composition->values()->firstOrCreate($value);
        }
    }
}
