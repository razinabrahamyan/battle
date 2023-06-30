<?php

namespace App\ExtraModels;

use App\Role;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'participants_permissions', 'participant_id', 'permission_id');
    }
}
