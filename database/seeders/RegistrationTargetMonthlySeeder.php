<?php

namespace Database\Seeders;

use App\Models\RegistrationTargetMonthly;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationTargetMonthlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegistrationTargetMonthly::updateOrCreate([
            'user_id' => User::first()->id,
            'month' => 'April',
            'year' => '2023',
            'target' => 35
        ]);
    }
}
