<?php

namespace App;

use App\Mutations\Json;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email',
        'role_id',
        'full_name',
        'status',
        'verified',
        'country_id',
        'state_id',
        'city_id',
        'additional',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'password_verification',
        'remember_token'
    ];

    protected $casts = [
        'full_name' => Json::class,
        'additional' => Json::class
    ];

    /**
     * @param $roles
     * @return bool
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles))
        {
            return $this->hasAnyRole($roles) || null;
        }
        return $this->hasRole($roles) || null;
    }

    /**
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->role()->whereIn('name', $roles)->first();
    }

    /**
     * Check user role
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * Get all of the user`s history.
     */
    public function history()
    {
        return $this->morphMany(History::class, 'historable');
    }
}
