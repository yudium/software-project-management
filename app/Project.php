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
        'price',
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

    public function PICs()
    {
        return $this->hasMany('App\PIC');
    }

    public function backup_source_code_project_links()
    {
        return $this->hasMany('App\BackupSourceCodeProjectLink');
    }

    public function project_links()
    {
        return $this->hasMany('App\ProjectLink');
    }

    public function termin()
    {
        return $this->hasOne('App\Termin');
    }
}
