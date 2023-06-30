<?php


namespace App\Traits;


use App\Request;
use Illuminate\Support\Carbon;

trait BattleTrait
{
    public function trendingBattles(){

    }
    public function usersBattles($user){
        return Request::where('creator_id',$user)
            ->orwhere('assignee_id',$user)
            ->with('battle')
            ->get()->pluck('battle','id');
    }
    public function verified($query){
        return $query->where('verified',1);
    }
    public function upcoming($query){
        return $query->where('start_date','>',Carbon::now(4));
    }
    public function previous($query){
        return $query->where('start_date','<',Carbon::now(4));
    }


}
