<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\FollowUp;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $followUp = FollowUp::updateOrCreate([
            'customer_id' => Customer::first()->id,
            'user_id'     => User::first()->id,
            'date_time'   => '2023-03-21',
            'lat'         => '457.745.001',
            'long'        => '154.254.256',
            'avatar'      => '',
            'note'        => 'not is not available'
        ]);
    }
}
