<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class single_invoice extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function Service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }

    // relations {{-- belongs to relation --}}
    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function Section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }


	/**
	 * @return mixed
	 */
	public function getGuarded() {
		return $this->guarded;
	}

	/**
	 * @param mixed $guarded
	 * @return self
	 */
	public function setGuarded($guarded): self {
		$this->guarded = $guarded;
		return $this;
	}
}
