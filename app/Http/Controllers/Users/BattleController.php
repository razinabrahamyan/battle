<?php

namespace App\Http\Controllers\Users;

use App\Battle;
use App\Http\Controllers\Controller;
use App\Library\Services\UsersServices\BattleService;
use App\Notifications\UserNotification;
use App\Reason;
use App\Traits\NotificationsTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class BattleController extends Controller
{
    use NotificationsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new battle.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(BattleService $service)
    {
        $opponent = null;
        if(\request()->opponent){
            $opponent = User::where('nickname',\request()->opponent)->first();
            if($opponent && $opponent->id === auth()->id())
                $opponent = null;
        }
        return $service->create('user_dashboard.create_battle',$opponent);
    }
    /**
     *  Store a newly created resource in storage.
     * @param BattleService $service
     * @param Request $request
     */
    public function store(BattleService $service,Request $request)
    {
        return $service->store($request->all());

    }
    /**
     * Display the specified resource.
     * @param BattleService $service
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(BattleService $service,$id,Request $request)
    {
        return $service->show('user_dashboard.battle',$id,$request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
