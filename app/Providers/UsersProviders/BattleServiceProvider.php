<?php

namespace App\Providers\UsersProviders;

use App\Library\Services\UsersServices\BattleService;
use Illuminate\Support\ServiceProvider;

class BattleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Services\UsersServices\BattleService', function ($app){
            return new BattleService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
