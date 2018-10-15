<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUpDealHistory extends Model
{
    /**
     * correspond to `status` column in table
     */
    const ISNT_DEAL     = 'N';
    const IS_DEAL       = 'Y';
    const IS_UNCERTAIN  = 'U';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'note',
    ];

    public $timestamps = false;

    public function follow_up_history()
    {
        return $this->belongsTo('App\FollowUpHistory');
    }

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case self::IS_DEAL: return 'Deal'; break;
            case self::ISNT_DEAL: return 'Tidak Deal'; break;
            case self::IS_UNCERTAIN: return 'Belum Pasti'; break;
        }
    }
}
