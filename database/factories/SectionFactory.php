<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;


class SectionFactory extends Factory
{
    protected $model=Section::class;
    

    public function definition(): array
    {
        return [
            // sections name
            'name' => $this->faker->unique()->randomElement(['قسم الجراحه','قسم المخ والأعصاب','قسم العيون','قسم الباطنه','قسم الطوارئ']),
            'description'=>$this->faker->paragraph(),
        ];
    }
}
