<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create(['name' => 'test']);
        Supplier::create(['name' => 'dizanarium']);
        Supplier::create(['name' => 'smart']);
        Supplier::create(['name' => 'fenix']);
    }
}
