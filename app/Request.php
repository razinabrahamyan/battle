<?php

namespace App;

use App\Mutations\Json;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'battle_id',
        'creator_id',
        'assignee_id',
        'request_timeout',
        'correction',
        'answer',
        'reason_id'
    ];
    protected $casts = [
        'correction'=>Json::class
    ];

    public function battle(){
        return $this->belongsTo(Battle::class);
    }

    public function creator(){
        return $this->belongsTo(User::class,'creator_id');
    }

    public function joiner(){
        return $this->belongsTo(User::class,'assignee_id');
    }

    public static function featured(){
        return (new static())::where('creator_id',auth()->id())
            ->orwhere('assignee_id',auth()->id())
            ->with(['battle' => function($query){
                $query->with('reminder')->get();
            }])
            ->get()
            ->pluck('battle','id')
            ->where('start_date','>',date('Y-m-d h:i:s'));
    }


}
