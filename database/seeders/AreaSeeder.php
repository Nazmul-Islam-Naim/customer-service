<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Area::updateOrCreate([
            'name' => 'Uttara',
            'address' => 'Uttara, Sector-6',
            'district_id' => District::first()->id,
        ]);
    }
}
