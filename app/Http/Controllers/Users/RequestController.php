<?php

namespace App\Http\Controllers\Users;

use App\Battle;
use App\Http\Controllers\Controller;
use App\Mail\BattleAlarm;
use App\Reason;
use App\Traits\NotificationsTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    use NotificationsTrait;
    public function usersAnswer(Request $request){
        switch ($request->attempt){
            case 'first':
                switch ($request->answer){
                    case 'accept' :
                        return $this->accept($request->battle,$request->attempt);
                        break;
                    case 'reject':
                        return $this->reject($request->battle,$request->attempt,$request->reason,$request->additional);
                        break;
                    case 'change':
                        return $this->change($request);
                        break;
                }
                break;
            case 'final':
                switch ($request->answer){
                    case 'accept':
                        return $this->accept($request->battle,$request->attempt);
                        break;
                    case 'reject':
                        return $this->reject($request->battle,$request->attempt);
                        break;
                }
                break;

        }

        return response()->json([
            'success'=>'error',
            'error'=>'wrong answer',
        ]);

    }
    private function accept($battle_id,$attempt){
        $battle = Battle::find($battle_id);
        $getter = $attempt === 'first'?'assignee_id' : 'creator_id';
        $battleRequest = \App\Request::where('battle_id',$battle_id)->where($getter,auth()->user()->id)->first();
        $battleRequest->update([
            'answer'=>'accepted'
        ]);
        $title = '';
        if($attempt === 'first'){
            $title = 'user '
                .auth()->user()->nickname
                .' accepted your request to battle '
                .$battle->title;
        }else{
            $title = 'user '
            .auth()->user()->nickname
            .' accepted your corrections to battle '
            .$battle->title;
        }
        $data = [
            'type' => 'request_answer',
            'data' => [
                'battle_id'=>$battle->id,
                'title' => $title,
                'image'=>auth()->user()->avatar,
                'nickname'=>auth()->user()->nickname,
                'address'=>auth()->user()->city->city['en'].','.auth()->user()->country->country['en']
            ],
            'answer'=>'accepted'
        ];
        $user = '';
        if($attempt === 'first'){
            $this->storeNotification($data,$battleRequest->creator_id);
            $this->sendUserNotification($data,$battleRequest->creator_id);
            $user = User::where('id',auth()->id())->with('city','country')->first();
        }else{
            $this->storeNotification($data,$battleRequest->assignee_id);
            $this->sendUserNotification($data,$battleRequest->assignee_id);
            $user = User::where('id',$battleRequest->assignee_id)->with('city','country')->first();
        }

        return response()->json([
            'success'=>'success',
            'answer'=>'accept',
            'attempt'=>$attempt,
            'message'=>'your answer was sent successfully',
            'user'=>$user
        ]);
    }

    private function reject($battle_id,$attempt,$reject_reason = null,$additional = null){
        $battle = Battle::find($battle_id);
        $getter = $attempt === 'first'?'assignee_id' : 'creator_id';
        $battleRequest = \App\Request::where('battle_id',$battle_id)->where($getter,auth()->user()->id)->first();
        $data = '';
        if($attempt === 'first'){
            $reason = Reason::where('id',$reject_reason)->first();
            $battleRequest->update([
                'answer'=>'rejected',
                'reason_id'=>$reject_reason,
                'corrections'=>['reason'=>$additional]
            ]);
            $data = [
                'type' => 'request_answer',
                'data' => [
                    'battle_id'=>$battle->id,
                    'title' => 'user '
                        .auth()->user()->nickname
                        .' rejected your request to battle '
                        .$battle->title,
                    'image'=>auth()->user()->avatar
                ],
                'answer'=>'rejected',
                'reason'=>$reason->reason
            ];
            $this->storeNotification($data,$battleRequest->creator_id);
            $this->sendUserNotification($data,$battleRequest->creator_id);
            $user = User::where('id',auth()->id())->with('city','country')->first();
            return response()->json([
                'success'=>'success',
                'answer'=>'reject',
                'attempt'=>$attempt,
                'message'=>'your answer was sent successfully',
                'user'=>$user
            ]);
        }else{
            $data = [
                'type' => 'request_answer',
                'data' => [
                    'battle_id'=>$battle->id,
                    'title' => 'user '
                        .auth()->user()->nickname
                        .' rejected your corrections to battle '
                        .$battle->title,
                    'image'=>auth()->user()->avatar,
                    'nickname'=>auth()->user()->nickname,
                    'address'=>auth()->user()->city->city['en'].','.auth()->user()->country->country['en']
                ],
                'answer'=>'rejected'
            ];
            $this->storeNotification($data,$battleRequest->assignee_id);
            $this->sendUserNotification($data,$battleRequest->assignee_id);
            $battleRequest->delete();
            $battle->delete();
            return response()->json([
                'success'=>'success',
                'answer'=>'reject',
                'attempt'=>$attempt,
                'message'=>'your answer was sent successfully',
            ]);
        }
    }

    private function change($request){
        $battle = Battle::find($request->battle);
        $battleRequest = \App\Request::where('battle_id',$request->battle)->where('assignee_id',auth()->user()->id)->first();
        $battleRequest->update([
            'answer' => 'correction',
            'correction' =>
                [
                    'start_date'=>$request->start_date,
                    'time'=>$request->time
                ]
        ]);
        $battle->update([
            'start_date'=>Date::parse($request->start_date.Carbon::create($request->time)->toTimeString()),
        ]);

        $data = [
            'type' => 'request_answer',
            'data' => [
                'battle_id'=>$battle->id,
                'title' => 'user '
                    .auth()->user()->nickname
                    .' made corrections to your request to battle '
                    .$battle->title,
                'image'=>auth()->user()->avatar
            ],
            'answer'=>'changed',
        ];
        $this->storeNotification($data,$battleRequest->creator_id);
        $this->sendUserNotification($data,$battleRequest->creator_id);
        $user = User::where('id',auth()->id())->with('city','country')->first();
        return response()->json([
            'success'=>'success',
            'answer'=>$request->answer,
            'attempt'=>$request->attempt,
            'message'=>'your answer was sent successfully',
            'user'=>$user
        ]);
    }

    public function invite(Request $request){

        if($request->type === 'user'){
            $user = User::find($request->user);
            $battle = Battle::find($request->battle);
            Mail::to($user->email)->send(new BattleAlarm(['title' => $battle->title, 'id' => $battle->id,'type' => 'invitation','user' => auth()->user()->nickname]));
            $this->sendUserNotification([
                'type'=>'invite',
                'data'=>[
                    'battle_id'=>$battle->id,
                    'title'=>'user '
                        .auth()->user()->nickname
                        .' invites you to view battle '
                        .$battle->title],
            ],$user->id);
            $this->storeNotification([
                'type' => 'invite',
                'data' => [
                    'battle_id'=>$battle->id,
                    'title' => 'user '
                        .auth()->user()->nickname
                        .' invites you to view battle '
                        .$battle->title
                ]
            ],$user);
            return response()->json([
                'success' => 'success',
                'request' => $request->all(),
                'message' => 'invitation sent'
            ]);

        }elseif ($request->type === 'email'){
            $battle = Battle::find($request->battle);
            Mail::to($request->email)->send(new BattleAlarm(['title' => $battle->title, 'id' => $battle->id,'type' => 'invitation','user' => auth()->user()->nickname]));
            return response()->json([
                'success' => 'success',
                'request' => $request->all(),
                'message' => 'invitation sent'
            ]);

        }
        return response()->json([
            'success' => 'error',
            'message' => 'something`s wrong'
        ]);
    }
}
