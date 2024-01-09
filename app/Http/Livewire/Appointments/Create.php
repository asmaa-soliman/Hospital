<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use Livewire\Component;

class Create extends Component
{
    public $doctors;
    public $sections;
    // input in form
    public $doctor;
    public $section;
    public $name;
    public $email;
    public $phone;
    public $notes;
    public $appointment_patient;
    // once it load
    public $message= false;
    public $message2= false;
    public function mount(){

        $this->sections = Section::get();
        $this->doctors = collect();

      }
    public function render()
    {
        return view('livewire.appointments.create',
        [
            'sections' => Section::get()
        ]);
    }
    // once section change do this func
    public function updatedSection($section_id){

        $this->doctors = Doctor::where('section_id',$section_id)->get();
     }
    //  method elsave when i press submit to data of appointments
     public function store(){


         //chek num_of_dailyexaminations to doctor

         $appointment_count = Appointment::where('doctor_id', $this->doctor)->where('type', 'unconfirmed')->where('appointment_patient', $this->appointment_patient)->count();
         $doctor_info = Doctor::find($this->doctor);

         if ($appointment_count == $doctor_info->num_of_examinations) {
             $this->message2 = true;
             return back();
         }
        $appointments = new Appointment();
        $appointments->doctor_id = $this->doctor;
        $appointments->section_id = $this->section;
        $appointments->name = $this->name;
        // dd($this->name);
        $appointments->email = $this->email;
        $appointments->phone = $this->phone;
        $appointments->notes = $this->notes;
        $appointments->appointment_patient = $this->appointment_patient;
        $appointments->save();
        // after data sent
        $this->message =true;
     }
}
