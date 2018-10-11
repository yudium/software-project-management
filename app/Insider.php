<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insider extends Model
{
    //
    public $timestamps = false;
    protected $table = 'client_orang_dalam';
    protected $fillable = [
        'name','position','address','photo','note'
    ];
}
