<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerminDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'due_date',
        'amount',
    ];

    public $timestamps = false;
}
