<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'prices',
        'starttime',
        'endtime',
        'endtime_actual',
        'DP_time',
        'additional_note',
        'status',
        'trello_board_id',
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function project_type()
    {
        return $this->belongsTo('App\ProjectType');
    }
}