<?php

namespace App;

use App\Mutations\Json;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['body','historable_id','historable_type'];
    protected $casts = [
        'body'=>Json::class,
    ];
    /**
     * Get all of the owning historable models.
     */
    public function historable()
    {
        return $this->morphTo();
    }
}
