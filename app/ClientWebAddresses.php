<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientWebAddresses extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'web_addresses',
   ];
}
