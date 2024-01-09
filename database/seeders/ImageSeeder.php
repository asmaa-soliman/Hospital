<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{

    public function run(): void
    {
        \App\Models\Image::factory()->count(10)->create();
    }
}
