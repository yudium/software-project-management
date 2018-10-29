<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerminPayment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serial_number',
        'pay_date',
        'amount',
        'photo_evidance',
    ];

    public $timestamps = false;

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }

    public function termin_detail()
    {
        return $this->belongsTo('App\TerminDetail');
    } 
}
