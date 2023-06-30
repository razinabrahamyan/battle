<?php

namespace App;

use App\Mutations\Json;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['data','user_id','reportable_id','reportable_type','reason_id'];
    protected $casts = [
        'data'=>Json::class,
    ];
    /**
     * Get all of the owning reportable models.
     */
    public function reportable()
    {
        return $this->morphTo();
    }

    public function reason(){
        return $this->belongsTo(Reason::class,'reason_id');
    }

    public function reporter(){
        return $this->belongsTo(User::class,'user_id');
    }
}
