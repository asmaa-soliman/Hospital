<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            // AppointmentSeeder::class,
            SectionSeeder::class,
            DoctorSeeder::class,
            ImageSeeder::class,
            PatientSeeder::class,
            ServiceSeeder::class,
            RayEmployeeSeeder::class,

        ]);
    }
}
