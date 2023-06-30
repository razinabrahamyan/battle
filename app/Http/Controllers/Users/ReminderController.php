<?php

namespace App\Http\Controllers\Users;

use App\Alarm;
use App\Battle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function setReminder(Request $request){
        $battle = Battle::find($request->battle);
        Alarm::create([
            'time'=>$battle->start_date,
            'user_id'=>auth()->id(),
            'battle_id'=>$battle->id,
        ]);
        return response()->json([
            'success' => 'success',
            'request' => $request->all(),
            'message' => 'reminder successfully set'
        ]);
    }
}
