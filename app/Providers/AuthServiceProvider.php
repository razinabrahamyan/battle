<?php

namespace App\Providers;

use App\ExtraModels\Permissions;
use App\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    function getPermissions()
    {
        return Permissions::query()->select('name', 'method')->get();
    }

    /**
     * @param $name
     * @param $method
     * @return bool
     */
    function getAdmin($name, $method)
    {
        $current_user = Auth::guard('admin')->user()->role->id;
        $permission = Role::find($current_user)->permissions()->where('name', $name)->where('method', $method)->first();
        if ($permission){
            return true;
        }
        return false;
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return bool
     */
    public function boot()
    {
        $this->registerPolicies();
        if (Schema::hasTable('permissions'))
        {
            Gate::define('permissions.view', function () {
                $this->getAdmin(1, 2);
                return Auth::guard('admin')->user()->role()->first()->name == 'superadmin';
            });
            foreach ($this->getPermissions() as $role)
            {
                Gate::define($role->name.'.'.$role->method, function ($user = null) use ($role) {
                    return $this->getAdmin($role->name, $role->method);
                });
            }
        }

    }
}
