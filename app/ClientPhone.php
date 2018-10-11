<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPhone extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'phone',
    ];
}
