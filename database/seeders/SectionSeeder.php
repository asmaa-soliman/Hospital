<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    
    public function run(): void
    {
        \App\Models\Section::factory()->count(5)->create();

    }
}
