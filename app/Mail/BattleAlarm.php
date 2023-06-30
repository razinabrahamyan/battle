<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BattleAlarm extends Mailable
{
    use Queueable, SerializesModels;
    private $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->data['type'] === 'invitation'){
            return $this->from('myvesuride@gmail.com','UBattle')->view('mail.battle_invite',['data' => $this->data]);
        }
        return $this->from('myvesuride@gmail.com','UBattle')->view('mail.battle_alert',['data' => $this->data]);
    }
}
