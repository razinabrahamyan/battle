<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Battle;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'rating_id',
        'social_profiles'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function statistic()
    {
        return $this->hasOne(Statistic::class, 'player_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function players()
    {
        return $this->belongsToMany(Player::class, 'partners_players', 'partner_id', 'player_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function partners()
    {
        return $this->belongsToMany(Player::class, 'partners_players', 'player_id', 'partner_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function battlesVote()
    {
        return $this->belongsToMany(Battle::class,'votes', 'player_id', 'battle_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'players_achievements','player_id', 'achievement_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function createdBattles()
    {
        return $this->belongsToMany(Battle::class, 'requests', 'creator_id', 'battle_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reportBattles()
    {
        return $this->belongsToMany(Battle::class, 'requests', 'player_id', 'battle_id');
    }







}
