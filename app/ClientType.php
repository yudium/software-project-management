<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icon', 'name',
    ];

    public $timestamps = false;

    public function clients()
    {
        return $this->hasMany('App\Client');
    }
}
