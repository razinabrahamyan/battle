<?php

namespace App\Providers;

use App\Library\Services\BattleService;
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
        $this->app->bind('App\Library\Services\BattleService', function ($app){
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
