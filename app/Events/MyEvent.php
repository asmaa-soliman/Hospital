<?php

namespace App\Events;

use App\Models\Patient;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    // send from event
    public $patient_id;
    public $invoice_id;
    public function __construct($data)
    {
        $patient = Patient::find($data['patient_id']);
        $this->patient_id = $patient->name;
        $this->invoice_id = $data['invoice_id'];
    }


    public function broadcastOn(): array
    {
        return ['my-channel'];
    }
}
