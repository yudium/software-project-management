<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TerminDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'due_date',
        'amount',
    ];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('withPaidAmountColumn', function(Builder $builder){
            $builder->select(\DB::raw('termin_details.*, ( SELECT SUM(amount) FROM termin_payments WHERE termin_payments.termin_detail_id = termin_details.id ) AS paid_amount'));
        });
    }

    public function termin()
    {
        return $this->belongsTo('App\Termin');
    }

    // AKA payment history
    public function termin_payments()
    {
        return $this->hasMany('App\TerminPayment');
    }
}
