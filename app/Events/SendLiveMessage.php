<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendLiveMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $message;
    private $channel;
    private $user;
    private $id;
    private $type;
    private $avatar;
    private $reaction_user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,$channel,$user,$id,$avatar = null,$type = null,$reaction_user = null)
    {
        $this->message = $message;
        $this->channel = $channel;
        $this->user = $user;
        $this->id = $id;
        $this->type = $type;
        $this->avatar = $avatar;
        $this->reaction_user = $reaction_user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->channel);
    }

    public function broadcastAs()
    {
        return 'new_message';
    }

    public function broadcastWith(){
        return ['message' => $this->message,'user'=>$this->user,'id'=>$this->id, 'type' => $this->type, 'avatar' => $this->avatar, 'reaction_user' => $this->reaction_user];
    }
}
