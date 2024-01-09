<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    public function run()
    {
        $Patients = new Patient();
        $Patients->email = 'patient@yahoo.com';
        $Patients->password = Hash::make('123456');
        $Patients->Date_Birth = '1988-12-01';
        $Patients->Phone = '123456789';
        $Patients->Gender = 1;
        $Patients->Blood_Group = 'A+';
        $Patients->save();

        //insert trans
        $Patients->name = 'أحمد السيد';
        $Patients->Address = 'المنصوره';
        $Patients->save();
    }
}
