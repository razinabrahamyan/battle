<?php

namespace App;

use App\ExtraModels\Permissions;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'title', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admins()
    {
        return $this->hasMany(Admin::class,'role_id', 'id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'participants_permissions', 'participant_id', 'permission_id');
    }
}
