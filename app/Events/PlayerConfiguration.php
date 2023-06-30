<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayerConfiguration implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $channel;
    private $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data,$channel)
    {
        $this->channel = 'player_config_'.$channel;
        $this->data = $data;
    }

    public function broadcastAs()
    {
        return 'player_configuration';
    }

    public function broadcastOn()
    {
        return new Channel($this->channel);
    }

    public function broadcastWith(){
        return ['data' => $this->data];
    }
}
