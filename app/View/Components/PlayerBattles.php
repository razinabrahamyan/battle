<?php

namespace App\View\Components;

use App\Battle;
use App\Category;
use App\Request;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class PlayerBattles extends Component
{

    private $user;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user = null)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $user = User::where('id',$this->user)->with(['createdEndedBattles','wins','joinedEndedBattles'])->first();
        $user->allBattlesCount = $user->createdEndedBattles->count() + $user->joinedEndedBattles->count();
        $user->wonBattlesCount = $user->wins->count();
        $user->lostBattlesCount = $user->allBattlesCount - $user->wonBattlesCount;
        $battles = Battle::where('creator_id',$this->user)->where('start_date','<',Carbon::now(4))
            ->orwhere('assignee_id',$this->user)->where('start_date','<',Carbon::now(4))
            ->limit(3)
            ->get();
        $categories = Battle::where('creator_id',$this->user)->orwhere('assignee_id',$this->user)->get()->groupBy('category_id')->sortBy(function ($battles){
            return count($battles);
        },1,true)->toarray();
        $categories = array_keys($categories);
        $categories = array_slice($categories,0,3);
        $categories = Category::whereIn('id',$categories)->get();
        return view('components.player-battles',['battles' => $battles,'user' => $user,'categories' => $categories]);
    }
}
