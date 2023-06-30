<?php

namespace App\Http\Controllers;

use App\Battle;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\BattleRequest;
use App\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $player = Player::find(3)->battlesVote;
        dd($player);
    }

    public function createBattle()
    {
        $categories = Category::get();
        return view('dashboard.test.battle_create.create', ['categories' => $categories]);
    }

    public function storeBattle(BattleRequest $request)
    {
        $battle = new Battle();
        $battle->title = $request->title;
        $battle->description = $request->description;
        $battle->gap = $request->gap;
        $battle->start_date =  Carbon::parse($request->start_date);
        $battle->end_date =  Carbon::parse($request->end_date);
        $battle->rounds = $request->rounds;
        $battle->category_id = $request->category_id;
        //$battle->save();
        $player = Player::find(1);
       // $player->createdBattles()->attach($battle->id);
        $player->createdBattles()->save($battle);

        return back();
    }
}
