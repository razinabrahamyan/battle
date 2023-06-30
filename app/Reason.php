<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $fillable = ['type','reason'];

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function rejects(){
        return $this->hasMany(Request::class);
    }
}
