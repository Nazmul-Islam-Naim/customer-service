<?php

namespace Database\Seeders;

use App\Models\FollowUp;
use App\Models\FollowUpProduct;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowUpProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FollowUpProduct::updateOrCreate([
            'follow_up_id' => FollowUp::first()->id,
            'product_id' => Product::first()->id
        ]);
    }
}
