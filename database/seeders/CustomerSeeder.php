<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\BusinessCategory;
use App\Models\Customer;
use App\Models\District;
use App\Models\Division;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::updateOrCreate([
            'name' => 'Md Sharif',
            'mobile' => '0197786222',
            'lat' => '120.526.5698',
            'long' => '240.526.456',
            'division_id' => Division::first()->id,
            'district_id' => District::first()->id,
            'area_id' => Area::first()->id,
            'business_cat_id' => BusinessCategory::first()->id,
            'user_id' => User::first()->id,
            'date' => '2023-03-19',
        ]);
    }
}
