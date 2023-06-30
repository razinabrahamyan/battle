<?php

namespace App\Http\Controllers;

use App\Battle;
use App\Events\BattleConfiguration;
use App\Events\PlayerConfiguration;
use App\Traits\NotificationsTrait;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    use NotificationsTrait;
    public function changeStatus(Request $request){
        $battle = Battle::find($request->battle);
        $self = null;
        if($battle->request->assignee_id === auth()->id()){
            $self = 'joiner';
        }elseif ($battle->request->creator_id === auth()->id()){
            $self = 'creator';
        }
        if($request->state === 'ready'){
            if($self){
                switch ($self){
                    case 'joiner':
                        switch ($battle->current_status){
                            case 'none':
                                $battle->current_status = 'joiner';
                                $battle->save();
                                $data = [
                                    'type' => 'ready',
                                    'data' => [
                                        'battle_id'=>$battle->id,
                                        'title' => 'user '
                                            .auth()->user()->nickname
                                            .' is ready to start battle '
                                            .$battle->title,
                                        'image'=>auth()->user()->avatar
                                    ],

                                ];
                                $this->storeNotification($data,$battle->request->creator_id);
                                $this->sendUserNotification($data,$battle->request->creator_id);
                                return response()->json([
                                    'success' => 'success',
                                    'status' => 'not_ready'
                                ]);
                                break;
                            case 'creator':
                                $battle->current_status = 'both';
                                $battle->save();
                                return response()->json([
                                    'success' => 'success',
                                    'status' => 'ready'
                                ]);
                                break;

                        }
                        break;
                    case 'creator':
                        switch ($battle->current_status){
                            case 'none':
                                $battle->current_status = 'creator';
                                $battle->save();
                                $data = [
                                    'type' => 'ready',
                                    'data' => [
                                        'battle_id'=>$battle->id,
                                        'title' => 'user '
                                            .auth()->user()->nickname
                                            .' is ready to start battle '
                                            .$battle->title,
                                        'image'=>auth()->user()->avatar
                                    ],

                                ];
                                $this->storeNotification($data,$battle->request->assignee_id);
                                $this->sendUserNotification($data,$battle->request->assignee_id);
                                return response()->json([
                                    'success' => 'success',
                                    'status' => 'not_ready'
                                ]);
                                break;
                            case 'joiner':
                                $battle->current_status = 'both';
                                $battle->save();
                                return response()->json([
                                    'success' => 'success',
                                    'status' => 'ready'
                                ]);
                                break;

                        }
                        break;

                }
            }
        }elseif ($request->state === 'end'){
            $battle->current_status = 'ended';
            $battle->save();
            return response()->json([
                'success' => 'success',
                'status' => 'ended'
            ]);
        }elseif ($request->state === 'start'){
            $battle->current_status = 'live';
            $battle->current_round = ['round' => 1,'turn' => 'creator', 'time' => now(4),'just_started' => 1];
            $battle->time = now(4);
            event(new BattleConfiguration(['type' => 'start'],$battle->id));
            $battle->save();
            return response()->json([
                'success' => 'success',
                'status' => 'live'
            ]);
        }

        return response()->json([
            'success' => 'error',
            'message' => 'something`s wrong'
        ]);


    }

    /**
     * check battles status
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkStatus(Request $request){
        $battle = Battle::find($request->battle);
        if($battle->current_status === 'both' || $battle->current_status === 'live'){
            return response()->json([
                'success' => 'success',
                'status' => 'ready'
            ]);
        }
        return response()->json([
            'success' => 'error',
            'status' => $battle->current_status
        ]);
    }


    public function markNotification(Request $request){
        $notifications = auth()->user()->unreadNotifications;
        if(count($notifications)) {
            $notif = auth()->user()->unreadNotifications->toQuery()->where('data->type', 'ready')->where('data->data->battle_id', $request->battle)->first();
            if ($notif) {
                auth()->user()->unreadNotifications->toQuery()->where('data->type', 'ready')->where('data->data->battle_id', $request->battle)->update([
                    'read_at' => now(4)
                ]);
            }
        }
        return response()->json([
            'success' => 'success',
            'message' => 'marked as read'
        ]);
    }

    public function finishRound(Request $request){
        $battle = Battle::find($request->battle);
        $self = null;
        if($battle){
            if($battle->request->assignee_id === auth()->id()){
                $self = 'joiner';
            }elseif ($battle->request->creator_id === auth()->id()){
                $self = 'creator';
            }
            $current_round = $battle->current_round['round'];
            $turn = $battle->current_round['turn'];
            switch ($self){
                case 'creator':
                    $battle->current_round = ['turn' => 'joiner', 'round' => $current_round, 'time' => now(4),'round_turn' => 0];
                    $battle->save();
                    event(new PlayerConfiguration(['type' => 'end_round','player' => 'joiner','round_turn' => false,'round' => $current_round],$battle->id));
                    event(new BattleConfiguration(['type' => 'end_round','player' => 'joiner','round_turn' => false,'round' => $current_round],$battle->id));
                    return response()->json([
                        'success' => 'success',
                        'round' => $current_round,
                        'round_turn' => false
                    ]);
                    break;
                case 'joiner':
                    if($current_round == $battle->rounds){
                        $battle->current_status = 'ended';
                        $battle->end_date = now(4);
                        $battle->save();
                        event(new PlayerConfiguration(['type' => 'end_battle','player' => 'creator'],$battle->id));
                        event(new BattleConfiguration(['type' => 'end_battle','player' => 'creator'],$battle->id));
                        return response()->json([
                            'success' => 'success',
                            'status' => 'ended'
                        ]);
                    }
                    $battle->current_round = ['turn' => 'creator', 'round' => intval($current_round)  + 1, 'time' => now(4),'round_turn' => 1];
                    $battle->save();
                    event(new PlayerConfiguration(['type' => 'end_round','player' => 'creator','round_turn' => true,'round' => intval($current_round)  + 1],$battle->id));
                    event(new BattleConfiguration(['type' => 'end_round','player' => 'creator','round_turn' => true,'round' => intval($current_round)  + 1],$battle->id));
                    return response()->json([
                        'success' => 'success',
                        'round' => intval($current_round)  + 1,
                        'round_turn' => true
                    ]);
                    break;

            }
        }
        return response()->json([
            'success' => 'error',
            'status' => $battle->current_status
        ]);
    }
    public function setView(Request $request){
        $battle = Battle::find($request->battle);
        if(!session()->has('battles')) {
            session()->put('battles', []);
        }
        if(!in_array($request->battle,session()->get('battles'))){
            session()->push('battles',$request->battle);
            if ($battle->views){
                $battle->increment('views',1);
            }else{
                $battle->views = 1;
                $battle->save();
            }
            event(new BattleConfiguration(['type' => 'count','count' => $battle->views],$battle->id));

        }
        return response()->json([
            'success' => 'success',
            'request' => $request->all()
        ]);
    }

}




















