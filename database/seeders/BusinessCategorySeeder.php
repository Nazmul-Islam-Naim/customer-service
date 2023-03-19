<?php

namespace Database\Seeders;

use App\Models\BusinessCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BusinessCategory::updateOrCreate([
            'name' => 'Hardware'
        ]);
    }
}
