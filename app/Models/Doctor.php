<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Doctor extends Authenticatable
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes =['name','appointments'];
     // معناها هيسمع كل الحاجات اللي هتدخل معايا
    // protected $guarded=[];
    public $fillable=['email','email_verified_at','password','phone','name','section_id','status','num_of_examinations'];


    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // 1 to 1 get section of doctor
    public function section(){
        return $this->belongsTo(Section::class);
    }

    // many to many relation
    public function doctorappointments(){
        return $this->belongsToMany(Appointment::class,'appointment_doctor');
    }
}
