<?php

namespace App\Http\Controllers\Users;

use App\Battle;
use App\Http\Controllers\Controller;
use App\Mail\BattleAlarm;
use App\Reaction;
use App\Subscription;
use App\User;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReactionController extends Controller
{
    public function setReaction(Request $request){
        $reaction = Reaction::where('user_id',auth()->id())->where('player_id',$request->user)->where('battle_id',$request->battle)->first();
        if ($reaction){
            $reaction->emoji_id = $request->emoji;
            $reaction->save();
        }else{
            Reaction::create([
                'user_id' => auth()->id(),
                'battle_id' => $request->battle,
                'player_id' => $request->user,
                'emoji_id' => $request->emoji
            ]);
        }

        return response()->json([
            'success' => 'success',
            'request' => $request->all()
        ]);
    }

    public function vote(Request $request){
        Vote::create([
            'voter_id' => auth()->id(),
            'player_id' => $request->user,
            'battle_id' => $request->battle
        ]);
        return response()->json([
            'success' => 'success',
            'request' => $request->all()
        ]);
    }


    public function subscribe(Request $request){
        Subscription::create([
            'battle_id' => $request->battle,
            'user_id' => auth()->id()
        ]);
        return response()->json([
            'success' => 'success',
            'request' => $request->all(),
            'message' => 'subscribed successfully'
        ]);
    }
    public function follow(Request $request){
        auth()->user()->followings()->attach($request->user);
        return response()->json([
            'success' => 'success',
            'request' => $request->all(),
            'message' => 'followed successfully'
        ]);
    }


    public function uninteresting(Request $request){
        auth()->user()->uninterestingBattles()->attach($request->battle);
        return response()->json([
            'success' => 'success',
            'request' => $request->all(),
            'message' => 'we took into account your opinion'
        ]);
    }


}
