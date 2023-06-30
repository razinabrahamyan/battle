<?php

use App\ExtraModels\Permissions;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'superadmin', 'title' => json_encode([
                'en' => 'Super Admin',
                'ru' => 'Super Admin',
                'am' => 'Super Admin'
            ])],
            ['name' => 'admin', 'title' => json_encode([
                'en' => 'Admin',
                'ru' => 'Admin',
                'am' => 'Admin'
            ])],
            ['name' => 'moderator', 'title' => json_encode([
                'en' => 'Moderator',
                'ru' => 'Moderator',
                'am' => 'Moderator'
            ])],
            ['name' => 'sponsor', 'title' => json_encode([
                'en' => 'Sponsor',
                'ru' => 'Sponsor',
                'am' => 'Sponsor'
            ])],
            ['name' => 'verifier', 'title' => json_encode([
                'en' => 'Verifier',
                'ru' => 'Verifier',
                'am' => 'Verifier'
            ])],
        ]);

        $permissions = new Permissions;
        $role = Role::find(1);
        $role->permissions()->saveMany($permissions->all());
    }
}
