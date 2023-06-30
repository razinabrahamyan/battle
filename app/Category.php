<?php

namespace App;

use App\Battle;
use App\Mutations\Json;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['base_id', 'style', 'title', 'description', 'status', 'svg','start_date', 'end_date'];

    protected $casts = [
        'title' => Json::class,
        'description' => Json::class
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function battles(){
        return $this->hasMany(Battle::class, 'category_id', 'id');
    }

    public function acceptedBattles(){
        return $this->battles()->where('verified','=','1');
    }
}
