<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title','description','image','country_id'];



    public function country(){
        return $this->belongsTo(Country::class);
    }
}
