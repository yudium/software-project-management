<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Termin extends Model
{
    /**
     * correspond to `paid_off` column in table
     */
    const IS_PAID_OFF          = '1';
    const IS_NOT_PAID_OFF      = '2';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'periodic_type',
        'paid_off',
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

    // access termin_payments record directly without through termin_detail table
    public function payments()
    {
        return $this->hasManyThrough('App\TerminPayment', 'App\TerminDetail')->orderBy('pay_date');
    }

    /**
     * Get current termin (termin detail)
     */
    public function getCurrentTerminDetailAttribute()
    {
        return $this->details()
            ->whereRaw('due_date >= CURDATE()')
            ->orderBy('due_date', 'asc')
            ->first();
    }
}
