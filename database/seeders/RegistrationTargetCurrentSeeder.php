<?php

namespace Database\Seeders;

use App\Models\RegistrationTargetCurrent;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationTargetCurrentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegistrationTargetCurrent::updateOrCreate([
            'user_id' => User::first()->id,
            'month' => 'April',
            'year' => '2023',
            'target' => 35
        ]);
    }
}
