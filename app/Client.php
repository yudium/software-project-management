<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * correspond to `status` column in table
     */
    const IS_CLIENT         = 0;
    const IS_PROSPECT       = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'business_relationship_status', 'photo'
    ];

    public function email()
    {
        return $this->hasMany('App\ClientEmail');
    }

    public function phone()
    {
        return $this->hasMany('App\ClientPhone');
    }

    public function city()
    {
        return $this->hasMany('App\ClientCity');
    }

    public function bankAccount()
    {
        return $this->hasMany('App\ClientBankAccount');
    }

    public function type()
    {
        return $this->belongsTo('App\ClientType', 'client_type_id');
    }


    public function getStatusTextAttribute($value)
    {
        return ($value == self::IS_CLIENT) ? 'client' : 'prospect';
    }
}

