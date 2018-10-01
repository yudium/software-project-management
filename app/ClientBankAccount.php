<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientBankAccount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bank_account',
    ];
}
