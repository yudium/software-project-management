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
        return $this->hasMany('App\ClientEmail','client_id');
    }

    public function phone()
    {
        return $this->hasMany('App\ClientPhone','client_id');
    }

    public function city()
    {
        return $this->hasMany('App\ClientCity');
    }

    public function bankAccount()
    {
        return $this->hasMany('App\ClientBankAccount');
    }

    public function webAddress()
    {
        return $this->hasMany('App\ClientWebAddresses');
    }

    public function address()
    {
        return $this->hasOne('App\ClientAddresses');
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

