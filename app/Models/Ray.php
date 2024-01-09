<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Ray extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function doctor()  {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    // علاقة مع مين ورابطها ب ايه
    public function employee()  {
        return $this->belongsTo(RayEmployee::class,'employee_id')
        ->withDefault(['name'=>'NoEmployee']);
    }

    public function Patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
