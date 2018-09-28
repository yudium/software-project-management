<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $filable = ['name','business_relationship_status','status',];
    protected $tables = 'clients';

    public function email()
    {
        return $this->hasMany('App\ClientEmail');
    }

    public function phone()
    {
        return $this->hasMany('App\ClientPhone');
    }

    public function type()
    {
        return $this->hasOne('App\ClientType','client_type_id');
    }

}

