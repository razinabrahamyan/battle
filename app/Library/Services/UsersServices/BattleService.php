<?php


namespace App\Library\Services\UsersServices;


use App\Admin;
use App\Battle;
use App\Category;
use App\Config;
use App\Emoji;
use App\ExtraModels\Settings;
use App\Library\Services\Contracts\UsersContracts\BattleContract;
use App\Notifications\AdminsNotification;
use App\Notifications\UserNotification;
use App\Reaction;
use App\Reason;
use App\Request;
use App\Subscription;
use App\User;
use App\Vote;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BattleService implements BattleContract
{

    public function store($data){
        $this->validate($data);
        $change_times = [5,10,15,20,25,30,35,40,45,50,55,60,90,120,150,180,300,600,1800,3600];
        $video_options  = [
            'screen_type' => $data['screen_type'],
            'auto_change' => array_key_exists('auto_change',$data) ? $change_times[intval($data['auto_change'])]: null,
            'round_change' => array_key_exists('round_change', $data) ? $data['round_change'] : null ,
            'mute' => array_key_exists('mute', $data) ? $data['mute'] : null ,

        ];

        $battle = Battle::create([
            'creator_id' => auth()->user()->id,
            'assignee_id' => $data['opponent_id'],
            'title'=>$data['title'],//
            'secret'=>'bat_'.Str::random(10).time(),//
            'description'=>$data['description'],
            'gap'=>$data['gap'],//
            'rounds'=>$data['rounds'],//
            'start_date'=>Date::parse($data['start_date'].Carbon::create($data['time'])->toTimeString()),//
            'end_date'=>$data['start_date'],//
            //'end_date'=>$data['end_date'],//
            'video_options'=>$video_options,//??
            'category_id'=>$data['category'],//
            'time'=>Date::parse($data['start_date'].Carbon::create($data['time'])->toTimeString()),//
        ]);
        $request = new Request;
        $request->creator_id = auth()->user()->id;
        $request->assignee_id = $data['opponent_id'];
        $request->correction = ['message' => $data['private_message']];
        $request->save();

        $battle->request()->save($request);

        Notification::send(
            Admin::where('role_id',3)->get(),
            new AdminsNotification([
                'data'=> ['title' => 'New Battle request from '.auth()->user()->nickname],
                'type' => 'battle_request'
            ])
        );
        $notification = new UserNotification([
            'type' => 'battle_request',
            'data' => [
                'battle_id'=>$battle->id,
                'title' => 'user '
                    .auth()->user()->nickname
                    .' invites you to battle '
                    .$battle->title
            ]
        ]);
        Notification::send(User::find($data['opponent_id']),$notification);

        event(new \App\Events\UserNotification([
                'type'=>'battle_request',
                'data'=>[
                    'battle_id'=>$battle->id,
                    'title'=>'user '
                        .auth()->user()->nickname
                        .' invites you to battle '
                        .$battle->title],
            ],$data['opponent_id'])
        );
        event(new \App\Events\AdminNotification('New Battle request from '.auth()->user()->nickname));
        return redirect()->route('user.home');
    }
    public function create($page,$opponent){
        $categories = Category::all();
        $rounds  = Settings::where('title', 'battle')->first();

        return view($page,['page'=>'battle','categories'=>$categories, 'rounds' => $rounds->attributes,'opponent' => $opponent]);
    }

    public function index($page)
    {

    }

    /**
     * @param $page
     * @param $id
     * @param $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($page, $id ,$request)
    {
        if($request->notification_id){
            if (auth()->check()){
                auth()->user()->unreadNotifications->where('id',$request->notification_id)->markAsRead();
            }

        }
        if(auth()->check()){
            $battle = Battle::where('id', $id)->with(['request' => function ($query){
                $query->with(['joiner', 'creator'])->get();
            }])->with('reminder')->first();
        }else{
            $battle = Battle::where('id', $id)->with(['request' => function ($query){
                $query->with(['joiner', 'creator'])->get();
            }])->first();
        }

        if ($battle ){
            $emojis = Emoji::all();
            $reject_reasons = Reason::where('type','reject_reason')->get();
            $report_reasons = Reason::where('type','report_reason')->get();
            $opponent = '';
            $reaction_second = null;
            $reaction_first = Reaction::where('user_id',auth()->id())->where('player_id',$battle->request->creator->id)->where('battle_id',$battle->id)->first();
            $has_voted = Vote::where('voter_id' , auth()->id())->where('battle_id' , $battle->id)->first();
            $subscribed = Subscription::where('battle_id', $battle->id)->where('user_id', auth()->id())->first();
            $uninteresting = null;
            if(auth()->check()){
                $uninteresting = auth()->user()->uninterestingBattles->contains($battle);
            }
            if($battle->request->answer === 'accepted'){
                $reaction_second = Reaction::where('user_id',auth()->id())->where('player_id',$battle->request->joiner->id)->where('battle_id',$battle->id)->first();
            }
            if(($battle->request->assignee_id !== auth()->id() && $battle->request->creator_id !== auth()->id()) || !auth()->check()){
                $playback = Config::where('name','WEBSOCKET_PLAYBACK_URI')->first()->value;
                return view('user_dashboard.battle_view',
                    [
                        'battle' => $battle,
                        'reject_reasons' => $reject_reasons,
                        'report_reasons' => $report_reasons,
                        'emojis' => $emojis,
                        'reaction_first' => $reaction_first,
                        'reaction_second' => $reaction_second,
                        'has_voted' => $has_voted,
                        'subscribed' => $subscribed,
                        'uninteresting' => $uninteresting,
                        'playback' => $playback,
                    ]
                );
            }
            if($battle->request->creator_id === auth()->id()){
                $opponent = $battle->request->joiner->nickname;
            }else{
                $opponent = $battle->request->creator->nickname;
            }
            $receiver = Config::where('name','WEBSOCKET_RECEIVER_URI')->first()->value;
            return view('user_dashboard.battle',
                [
                    'opponent' => $opponent,
                    'battle' => $battle,
                    'reject_reasons' => $reject_reasons,
                    'report_reasons' => $report_reasons,
                    'emojis' => $emojis,
                    'reaction_first' => $reaction_first,
                    'reaction_second' => $reaction_second,
                    'has_voted' => $has_voted,
                    'receiver' => $receiver,
                ]
            );
        }
        return redirect()->route('user.home');

    }

    /**
     * @param $page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($page, $id)
    {

    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($data, $id)
    {

    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function destroy($id)
    {

    }


    public function validate($data){
        $settings = Settings::where('title', 'battle')->firstOrFail();
        $rounds_max= $settings->attributes['rounds_max'];
        $rounds_min= $settings->attributes['rounds_min'];
        return Validator::make($data,[
            'title'=>'string|required|max:64',//
            'category'=>'required|numeric',//
            'start_date'=>'date|required',//
            'gap'=>'required|numeric|min:0',//
            'rounds'=>"required|numeric|min:$rounds_min|max:$rounds_max",//
            'time'=>'string|required',//????????????????
            'opponent_id'=>'required',//
            'screen_type'=>'required|string',//
            'round_change'=>'boolean',
            'mute' => 'boolean',
            'description' =>'nullable|string|max:512',
            'private_message' => 'nullable|string|max:512'
            ])->validate();
    }
}
