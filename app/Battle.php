<?php

namespace App;

use App\Mutations\Json;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class Battle extends Model
{
    protected $fillable = [
        'title',
        'description',
        'gap',
        'rounds',
        'start_date',
        'end_date',
        'video_options',
        'current_status',
        'current_round',
        'status',
        'category_id',
        'secret',
        'views',
        'verified',
        'time',
        'creator_id',
        'assignee_id'
    ];

    protected $casts = [
        'video_options' => Json::class,
        'current_round' => Json::class
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function playersVote()
    {
        return $this->belongsToMany(Player::class, 'vote', 'battle_id', 'player_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function creatorPlayer()
    {
        return $this->request->creator();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reportPlayers()
    {
        return $this->belongsToMany(Player::class, 'requests', 'battle_id', 'assignee_id');
    }

    public function request(){
        return $this->hasOne(Request::class,'battle_id');
    }

    public function reports(){
        return $this->morphMany(Report::class, 'reportable');
    }

    public static function upcoming(){
        return (new static())::where('start_date','>',date('Y-m-d h:i:s'))
            ->with('reminder')
            ->join('requests','requests.battle_id','=','battles.id')
            ->where('requests.creator_id','!=',auth()->id())
            ->where('requests.assignee_id','!=',auth()->id())
            ->where('answer','accepted');
    }
    public static function latest(){
        return (new static())::where('start_date','<',date('Y-m-d h:i:s'))
            ->orderBy('start_date','DESC')->with('reminder');
    }

    public function subscribedUsers(){
        return $this->belongsToMany(User::class, 'subscriptions');
    }

    public function actualBattles(){
        return (new static())::where('current_status','!==','ended');
    }

    public function reminder(){
        return $this->belongsToMany(User::class, 'alarms')->wherePivot('user_id',auth()->id());
    }

    public function votes($id)
    {
        return $this->hasMany(Vote::class)->where('player_id',$id);
    }

    public function creator(){
        return $this->belongsTo(User::class,'creator_id');
    }

    public function joiner(){
        return $this->belongsTo(User::class,'assignee_id');
    }



}
