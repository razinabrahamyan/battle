<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['user_id','player_id','battle_id','emoji_id'];


    public function emoji(){
        return $this->belongsTo(Emoji::class,'emoji_id');
    }
}
