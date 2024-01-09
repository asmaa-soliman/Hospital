<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // to avoid repeat 
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' =>'admin@gmail.com',
            'password' => Hash::make('@c.1m'),
        ]);
    }
}
