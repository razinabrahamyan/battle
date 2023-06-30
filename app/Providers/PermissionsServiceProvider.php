<?php

namespace App\Providers;


use App\ExtraModels\Permissions;
use App\Role;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('dashboard.permissions.index', function($view) {
            $locale = app()->getLocale();
            $roles = Role::whereNotIn('id', [1])->select('id', "title->$locale as title")->get();
            $permissions = Permissions::whereNotIn('name', ['permissions'])->get()->groupBy('name');
            $view->with(['roles' => $roles, 'permissions' => $permissions]);
        });
    }
}
