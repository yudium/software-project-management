<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','username','address','city','photo'];

    public function email()
    {
        return $this->hasMany('App\AgentEmail');
    }

    public function bankAccount()
    {
        return $this->hasManyy('App\AgentBankAccount');
    }

    public function phone()
    {
        return $this->hasMany('App\AgentPhone');
    }

    public function webAddress()
    {
        return $this->hasMany('App\AgentWebAddresses');
    }


}
