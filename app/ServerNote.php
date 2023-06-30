<?php

namespace App;

use App\Mutations\Json;
use Illuminate\Database\Eloquent\Model;

class ServerNote extends Model
{
    protected $fillable = ['data'];
    protected $casts = [
        'data' => Json::class
    ];
}
