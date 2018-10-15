<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUpHistory extends Model
{
    /**
     * correspond to `status` column in table
     */
    const HASNT_FOLLOWED_UP = 0;
    const HAS_FOLLOWED_UP   = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'note',
    ];

    public function potential_project()
    {
        return $this->belongsTo('App\PotentialProject');
    }

    public function deal_history()
    {
        return $this->hasOne('App\FollowUpDealHistory', 'follow_up_history_id', 'id');
    }

    public function getStatusTextAttribute()
    {
        return ($this->status == self::HAS_FOLLOWED_UP) ? 'Sudah' : 'Belum';
    }
}
