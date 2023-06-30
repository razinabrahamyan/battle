<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['from','to'];

    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function lastMessage(){
        return $this->hasOne(Message::class)->latest();
    }
    public function fromUser(){
        return $this->belongsTo(User::class,'from');
    }
    public function toUser(){
        return $this->belongsTo(User::class,'to');
    }

}
