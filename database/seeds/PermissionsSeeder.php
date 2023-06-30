<?php

use App\ExtraModels\Permissions;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = [
            'view',
            'store',
            'create',
            'show',
            'edit',
            'update',
            'destroy'
        ];

        $controllers = ['admin', 'moderator', 'sponsor', 'verifier'];
        foreach ($controllers as $controller)
        {
            foreach ($methods as $method)
            {
                $permissions = new Permissions();
                $permissions->name = $controller;
                $permissions->method = $method;
                $permissions->save();
            }
        }
    }
}
