<?php

namespace App;

use App\Mutations\Json;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
        'email',
        'password',
        'full_name',
        'package_id',
        'email_verified_at',
        'password_verification',
        'verified',
        'country_id',
        'state_id',
        'city_id',
        'additional',
        'nickname',
        'dob',
        'avatar'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        return $this->withTrashed();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'full_name' => Json::class,
        'additional' => Json::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function player()
    {
        return $this->hasOne(Player::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    /**
     * Get all of the user`s history.
     */
    public function history()
    {
        return $this->morphMany(History::class, 'historable');
    }

    public function reports(){
        return $this->morphMany(Report::class, 'reportable');
    }

    public function reportsMade(){
        return $this->hasMany(Report::class);
    }

    public function lang()
    {
        return $this->belongsTo(Locales::class, 'lang_id');
    }

    public function creatorAssignee()
    {
        return $this->belongsToMany(User::class, 'requests', 'creator_id', 'assignee_id');
    }


    public function assigneeCreator()
    {
        return $this->belongsToMany(User::class, 'requests', 'assignee_id', 'creator_id');
    }

    public function subscriptions(){
        return $this->belongsToMany(Battle::class, 'subscriptions');
    }

    public function alertBattles(){
        return $this->belongsToMany(Battle::class, 'alarms');
    }

    public function followers(){
        return $this->belongsToMany(User::class, 'followers_players','player_id','follower_id');
    }

    public function followings(){
        return $this->belongsToMany(User::class, 'followers_players','follower_id','player_id');
    }

    public function uninterestingBattles(){
        return $this->belongsToMany(Battle::class, 'uninterestings');
    }

    public function wins(){
        return $this->hasMany(Result::class);
    }

    public function createdEndedBattles(){
        return $this->hasMany(Battle::class,'creator_id')->where('current_status','ended');
    }
    public function joinedEndedBattles(){
        return $this->hasMany(Battle::class,'assignee_id')->where('current_status','ended');
    }

}
