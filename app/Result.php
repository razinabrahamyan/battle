<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable =[
        'battle_id','won_id'
    ];
}
