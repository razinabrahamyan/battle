<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $data;
    private $id;
    private $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id,$data,$type = null)
    {
        $this->data = $data;
        $this->id = $id;
        $this->type = $type;
        if(!$type){
            $this->type = 'message';
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('message.'.$this->id);
    }

    public function broadcastAs()
    {
        return 'new_chat_message';
    }

    public function broadcastWith(){
        return ['data' => $this->data,'id'=>$this->id,'user' => auth()->user(),'type' => $this->type];
    }
}
