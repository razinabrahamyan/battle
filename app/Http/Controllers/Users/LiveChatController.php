<?php

namespace App\Http\Controllers\Users;

use App\Chat;
use App\Events\BattleConfiguration;
use App\Events\SendLiveMessage;
use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class LiveChatController extends Controller
{
    /**
     * LiveChatController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendLiveMessage(Request $request){
        if($request->reaction){
            event(new SendLiveMessage($request->message,$request->channel,auth()->user()->nickname,auth()->id(),null,$request->reaction,$request->user));
            return response()->json([
                'success'=>'success',
                'type' => 'reaction'
            ]);
        }
        event(new SendLiveMessage($request->message,$request->channel,auth()->user()->nickname,auth()->id(),auth()->user()->avatar));
        return response()->json([
            'success'=>'success',
            'type' => 'message'
        ]);
    }

    public function sendMessage(Request $request){
        $chat = Chat::where('from',auth()->id())->where('to',$request->opponent)->orWhere('to',auth()->id())->where('from',$request->opponent)->first();
        $first_message = false;
        if(!$chat){
            $chat = Chat::create([
                'from' => auth()->id(),
                'to' => $request->opponent
            ]);
            $first_message = true;
        }
        $chat->messages()->create([
            'from' => auth()->id(),
            'to' => $request->opponent,
            'message' => ['body' => $request->message]
        ]);
        $chat_user = null;
        if ($chat->from == auth()->id()){
            $chat_user = $chat->toUser;
        }else{
            $chat_user = $chat->fromUser;
        }
        event(new SendMessage($request->opponent,['message' => $request->message ,'time' => Carbon::now(4)->format('H:i'),'chat_id' => $chat->id, 'first_message' => $first_message, 'chat_user' => auth()->user()]));
        return response()->json([
            'success'=>'success',
            'type' => $request->all(),
            'first_message' => $first_message,
            'chat_id' => $chat->id,
            'chat_user' => $chat_user
        ]);
    }

    public function messageSeen(Request $request){

        Message::where('to',auth()->id())->where('chat_id',$request->chat)->where('read_at',null)->update([
            'read_at' => Date::now()
        ]);
        return response()->json([
            'success'=>'success',
            'type' => $request->all()
        ]);
    }

    public function typing(Request $request){
        $chat = Chat::where('from',auth()->id())->where('to',$request->opponent)->orWhere('to',auth()->id())->where('from',$request->opponent)->first();
        if($chat){
            event(new SendMessage($request->opponent,['chat_id' =>$chat->id ],'typing'));
        }
        return response()->json([
            'success'=>'success',
            'type' => $request->all()
        ]);
    }
}
