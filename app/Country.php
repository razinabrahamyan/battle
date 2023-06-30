<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'country',
        'nationality',
        'status'
    ];

    protected $casts = [
        'country'=>'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states()
    {
        return $this->hasMany(State::class, 'country_id', 'id');
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'country_id', 'id');
    }

    public function getColumnNameAttribute($value) {
        return json_decode($value);
    }
}
