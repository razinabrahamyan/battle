<?php

namespace App;

use App\Mutations\Json;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['from','to','read_at','message','chat_id'];

    protected $casts = [
        'message' => Json::class,
    ];

    public function sender(){
        return $this->belongsTo(User::class,'from');
    }

    public function chat(){
        return $this->belongsTo(Chat::class);
    }
}
