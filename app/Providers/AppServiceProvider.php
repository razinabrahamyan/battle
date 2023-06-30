<?php

namespace App\Providers;

use App\Chat;
use App\Country;
use App\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['dashboard.admins.create', 'dashboard.users.create'], function ($view) {
            $locale = app()->getLocale();
            $default = config('app.fallback_locale');

            $countries = Country::when(Country::where("country->$locale", '!=', null)->exists(), function ($query) use($locale){
                return $query->select('id', "country->$locale as name");
            }, function ($query) use($default){
                return $query->select('id', "country->$default as name");
            })->get();

            $view->with([
                'countries' => $countries,
            ]);
        });

        View::composer('*', function ($view){
            if (request()->route()!== null && request()->route()->getPrefix() == '/dashboard')
            {
                $view->with([
                    'admin_notification' =>  auth()->guard('admin')->user()->unreadNotifications
                ]);
            }else{
                if(auth()->check()){
                    $chats = Chat::where('from',auth()->id())->orWhere('to',auth()->id())->with(['fromUser','toUser','lastMessage' => function($query){
                        $query->with('sender');
                    }])->get()->sortBy(function($message){
                        return $message->lastMessage ? $message->lastMessage->created_at : '';
                    },0,'desc');
                    $unread_messages_count = 0;
                    foreach ($chats as $chat){
                        if(!$chat->lastMessage->read_at && $chat->lastMessage->sender->id !== auth()->id()){
                            $unread_messages_count = $unread_messages_count + 1;
                        }
                    }
                    $view->with([
                        'player' =>  auth()->user()->player,
                        'battle_coming' => Request::where('creator_id',auth()->id())
                            ->orwhere('assignee_id',auth()->id())
                            ->with('battle')
                            ->get()
                            ->pluck('battle','id')
                            ->where('start_date','>',now(4))
                            ->sortBy('start_date')
                            ->first(),
                        'chats' => $chats,
                        'unread_messages_count' => $unread_messages_count
                    ]);
                }else{
                    $countries = Country::all();
                    $view->with([
                        'countries' =>  $countries
                        ]);

                }

            }

        });
    }
}
