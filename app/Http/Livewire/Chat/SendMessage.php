<?php

namespace App\Http\Livewire\Chat;

use App\Events\SentMessage;
use App\Events\SentMessage2;
use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SendMessage extends Component
{
    public $body;
    public $auth_email;
    public $selected_conversation;
    public $receviverUser;
    protected $listeners = ['updateMessage','dispatchSentMassage','updateMessage2'];
    public $sender;
    public $createdMessage;


    public function mount()
    {
        if(Auth::guard('patient')->check()){
            $this->auth_email =Auth::guard('patient')->user()->email;
            $this->sender=Auth::guard('patient')->user();
        }
        else{
            $this->auth_email =Auth::guard('doctor')->user()->email;
            $this->sender=Auth::guard('doctor')->user();
        }

    }

    // who sender and whon conversitation
    public function updateMessage(Conversation $conversation, Doctor $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
    }
    public function updateMessage2(Conversation $conversation, Patient $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
    }
    public function sendMessage()
    {
        // if send empty message
        if ($this->body == null) {
            return null;
        }
        // insert mssg in database
        $this->createdMessage = Message::create([
            'conversation_id' => $this->selected_conversation->id,
            'sender_email' => $this->auth_email,
            'receiver_email' => $this->receviverUser->email,
            'body' => $this->body,
        ]);
        // last time to message
        $this->selected_conversation->last_time_message =  $this->createdMessage->created_at;
        $this->selected_conversation->save();
        // empty body of message
        $this->reset('body');
        // after save in database update it withoutrefresh(event emitto )
        $this->emitTo('chat.chatbox','pushMessage', $this->createdMessage->id);
        // refresh and put last message in chatlist
        $this->emitTo('chat.chatlist','refresh');
        // Push Message In ChatBox&ChatLisRealTime
        $this->emitSelf('dispatchSentMassage',);
    }
    public function dispatchSentMassage()
    {
        if (Auth::guard('patient')->check()) {
            broadcast(new SentMessage(
            $this->sender,
            $this->createdMessage,
            $this->selected_conversation,
            $this->receviverUser
        ));
        }else{
            broadcast(new SentMessage2(
                $this->sender,
                $this->createdMessage,
                $this->selected_conversation,
                $this->receviverUser
            ));
        }
    }
    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
