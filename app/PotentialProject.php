<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PotentialProject extends Model
{
    /**
     * correspond to `status` column in table
     *
     * NOTE: be careful when comparing with == operator. Use NULL as right
     *       operand of that operator if want to check current project is
     *       *NOT BOTH* condition: isn't deal or deal.
     *
     * example:
     *      if (self::status == self::ISNT_DEAL ||
     *          self::status == self::IS_DEAL)
     *
     *      with assumption self::status == NULL then the if-condition is always
     *      return true because NULL == 0 (ISNT_DEAL)
     */
    const ISNT_DEAL = 0;
    const IS_DEAL = 1;

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
