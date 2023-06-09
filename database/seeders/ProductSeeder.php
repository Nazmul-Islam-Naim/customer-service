<?php

namespace Database\Seeders;

use App\Models\BusinessCategory;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::updateOrCreate([
            'name' => 'Gear',
            'business_cat_id' => BusinessCategory::first()->id,
        ]);
    }
}
