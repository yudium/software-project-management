<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Termin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'periodic_type',
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function details()
    {
        return $this->hasMany('App\TerminDetail');
    }
}
