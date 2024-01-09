<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{

    public function run(): void
    {
        // foreach ($doctors as $doctor){
        //     $Appointments = Appointment::all()->random()->id;
        //     $doctor->doctorappointments()->attach($Appointments);
        // }
        // الدكتور يكون متاح ليه اكتر من ميعاد

         Doctor::factory()->count(10)->create();
        // $appointments = Appointment::all();
        // Doctor::all()->each(function ($doctor) use ($appointments) {
        //     $doctor->doctorappointments()->attach(
        //        $appointments->random(rand(1,7))->pluck('id')->toArray()
        //     );
        // });
    }
}
