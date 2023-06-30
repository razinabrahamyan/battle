<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    protected $fillable = ['user_id','battle_id','time','status'];

    public function battle(){
        return $this->belongsTo(Battle::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
