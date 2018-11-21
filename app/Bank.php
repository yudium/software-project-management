<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'account_number',
        'owner',
    ];

    public $timestamps = false;
}
