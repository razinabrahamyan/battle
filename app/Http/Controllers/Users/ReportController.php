<?php

namespace App\Http\Controllers\Users;

use App\Admin;
use App\Battle;
use App\Http\Controllers\Controller;
use App\Notifications\AdminsNotification;
use App\Report;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ReportController extends Controller
{
    public function report(Request $request){
        if($request->report_on === 'battle'){
            $battle = Battle::find($request->battle);
            $battle->reports()->create([
                    'user_id' => auth()->id(),
                    'reason_id' => $request->report_about,
                    'data' => ['additional' => $request->additional]
                ]);
            Notification::send(
                Admin::where('role_id',3)->get(),
                new AdminsNotification([
                    'data' => ['title' => 'New report from '.auth()->user()->nickname.' on battle '.$battle->title],
                    'type' => 'report'
                    ])
            );
            event(new \App\Events\AdminNotification([
                'title' => 'New report from '.auth()->user()->nickname.' on battle '.$battle->title,
                'type' => 'report'
                ]));
        }else{
            $user = User::find($request->report_on);
            $user->reports()->create([
                'user_id' => auth()->id(),
                'reason_id' => $request->report_about,
                'data' => ['additional' => $request->additional]
            ]);
            Notification::send(
                Admin::where('role_id',3)->get(),
                new AdminsNotification([
                    'data' => ['title' => 'New report from '.auth()->user()->nickname.' on user '.$user->nickname],
                    'type' => 'report'
                ])
            );
            event(new \App\Events\AdminNotification([
                'title' => 'New report from '.auth()->user()->nickname.' on user '.$user->nickname,
                'type' => 'report'
                ]));
        }
        return response()->json([
            'success' => 'success',
            'request' => $request->all(),
            'message' => 'report sent successfully'
        ]);
    }
}
