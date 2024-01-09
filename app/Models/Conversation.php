<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function scopechekConversation($query,$auth_email,$receiver_email){

        // user which is active may be recevier or sender
        return $query->where('sender_email',$auth_email)
            ->where('receiver_email',$receiver_email)->orwhere('receiver_email',$auth_email)->
            where('sender_email',$receiver_email);
    }

    // relation
    public function messages(){
        return $this->hasMany(Message::class);
    }
}
