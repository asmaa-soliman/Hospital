<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


class DoctorFactory extends Factory
{


    // معناها هيفهم اللي جوا الاراي الديفينيشن اللي تحت
    protected $model=Doctor::class;

    public function definition(): array
    {
        return [

            // on translation doctor table
            'name' => $this->faker->name,
            // on doctor table
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone' => $this->faker->phoneNumber,
            'section_id' => Section::all()->random()->id,
            'num_of_examinations'=>5,
        ];
    }
}
