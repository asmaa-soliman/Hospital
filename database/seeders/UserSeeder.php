<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        // to avoid repeat 
        DB::table('users')->delete();
        
        DB::table('users')->insert([
            'name' =>'user',
            'email' =>'user@gmail.com',
            'password' => Hash::make('@c.1m'),
        ]);
    }
}
