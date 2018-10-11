<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PotentialProject extends Model
{
    /**
     * correspond to `status` column in table
     */
    const ISNT_DEAL = 0;
    const ISN_DEAL = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_name',
    ];

    public function follow_up_histories()
    {
        return $this->hasMany('App\FollowUpHistory', 'potential_project_id', 'id');
    }

    public function deal_histories()
    {
        return $this->hasManyThrough(
            'App\FollowUpDealHistory',
            'App\FollowUpHistory',
            'potential_project_id',
            'follow_up_history_id',
            'id',
            'id'
        );
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function project_type()
    {
        return $this->belongsTo('App\ProjectType');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
