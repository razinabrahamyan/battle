<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'city',
        'country_id',
        'state_id',
        'status'
    ];

    protected $casts = [
        'city'=>'array'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admins()
    {
        return $this->hasMany(Admin::class, 'city_id', 'id');
    }

    public function getColumnNameAttribute($value) {
        return json_decode($value);
    }
}
