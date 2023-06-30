<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BattleConfiguration implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $data;
    private $channel;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data,$channel)
    {
        $this->data = $data;
        $this->channel = 'config_'.$channel;
    }



    public function broadcastAs()
    {
        return 'new_configuration';
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


    public function broadcastWith(){
        return ['data' => $this->data];
    }
}
