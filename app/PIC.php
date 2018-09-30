<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PIC extends Model
{
    /**
     * Prevent laravel assumes as _p_i_c_s
     */
    public $table = '_p_i_c';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
