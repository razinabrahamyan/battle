<?php

namespace App\ExtraModels;

use App\Mutations\Json;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = ['title', 'attributes'];

    protected $casts = ['attributes' => Json::class];

}
