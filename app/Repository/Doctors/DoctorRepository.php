<?php
namespace App\Repository\Doctors;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Section;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $doctors = Doctor::with('doctorappointments')->get();
        return view('Dashboard.Doctors.index',compact('doctors'));
    }

    public function create()
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctors.add',compact('sections','appointments'));
    }


    public function store($request){

        // use it cause i will save data in 2 tables if any first problem ha uostop then roolback
        DB::beginTransaction();

        try {

            $doctors = new Doctor();
            $doctors->email = $request->email;
            $doctors->password = Hash::make($request->password);
            $doctors->section_id = $request->section_id;
            $doctors->phone = $request->phone;
            $doctors->status = 1;
            $doctors->save();
            // store trans
            $doctors->name = $request->name;
            $doctors->save();

            // table 3 pivot
            $doctors->doctorappointments()->attach($request->appointments);
            //Upload img
            $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\Doctor');

            DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.create');

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function update($request)
    {
        DB::beginTransaction();

        try {

            $doctor = Doctor::findorfail($request->id);

            $doctor->email = $request->email;
            $doctor->section_id = $request->section_id;
            $doctor->phone = $request->phone;
            $doctor->save();
            // store trans
            $doctor->name = $request->name;
            $doctor->save();

            // update pivot tABLE
            $doctor->doctorappointments()->sync($request->appointments);

            // update photo
            if ($request->has('photo')){
                // Delete old photo
                if ($doctor->image){
                    $old_img = $doctor->image->filename;
                    $this->Delete_attachment('upload_image','doctors/'.$old_img,$request->id);
                }
                //Upload img
                $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$request->id,'App\Models\Doctor');
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->back();

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        } 
        
        
    }

    public function destroy($request)
    {
        // if has id =1 and has image
        if($request->page_id==1){
            if($request->filename){
                // delete image
                $this->Delete_Attachment('upload_image','doctors/'.$request->filename,$request->id);
            }
            // has no image delete from db
            Doctor::findOrFail($request->id)->delete();
             session()->flash('delete');
            return redirect()->route('Doctors.index');
        }
        // delete more than doctor
        else
        {
             // delete selector doctorلو جاي باكتر من اي دي 
          $delete_select_id = explode(",", $request->delete_select_id);
          foreach ($delete_select_id as $ids_doctors){
            // take data of ids doctor from  database
              $doctor = Doctor::findorfail($ids_doctors);
              if($doctor->image){
                  $this->Delete_attachment('upload_image','doctors/'.$doctor->image->$doctor->image->filenamefilename,$ids_doctors,);
              }
          }

          Doctor::destroy($delete_select_id);
          session()->flash('delete');
          return redirect()->route('Doctors.index');

        }
    }

    public function edit($id)
    {
        // هات الاقسام كلها
        $sections=Section::all();
        $appointments=Appointment::all();
        $doctor=Doctor::findorFail($id);
        return view('Dashboard.Doctors.edit',compact('sections','appointments','doctor'));
    }


    // update_password
    public function update_password($request){
       
            try {
                $doctor = Doctor::findorfail($request->id);
                $doctor->update([
                    'password'=>Hash::make($request->password)
                ]);
    
                session()->flash('edit');
                return redirect()->back();
            }
    
            catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
    }

     // update_password
    public function update_status($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->update([
                'status'=>$request->status
            ]);

            session()->flash('edit');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



}