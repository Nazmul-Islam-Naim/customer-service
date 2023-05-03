<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(DesignationSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(userSeeder::class);
        // $this->call(BusinessCategorySeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(CustomerSeeder::class);
        // $this->call(RegistrationTargetCurrentSeeder::class);
        // $this->call(RegistrationTargetMonthlySeeder::class);
    }
}
