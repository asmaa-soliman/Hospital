<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmation extends Mailable
{

    use Queueable,SerializesModels;
    public $appointment;
    public $name;
    public function __construct($name,$appointment)
    {
        $this->name=$name;
        $this->appointment=$appointment;
    }
    public function build()
    {
        return $this->markdown('emails.appoinments')->subject('تأكيد الموعد');
    }





}
