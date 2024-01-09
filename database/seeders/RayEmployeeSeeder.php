<?php

namespace Database\Seeders;
use App\Models\RayEmployee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class RayEmployeeSeeder extends Seeder
{
    public function run()
    {
        $ray_employee = new RayEmployee();
        $ray_employee->name = 'أيمن السيد';
        $ray_employee->email = 'm@yahoo.com';
        $ray_employee->password = Hash::make('123456');
        $ray_employee->save();
    }
}
