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
        'serial_number',
        'due_date',
        'amount',
    ];

    protected $casts = [
        'paid_amount' => 'integer',
    ];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        // Now we have @property $paid_amount that very useful, represent money that client has been paid
        static::addGlobalScope('withPaidAmountColumn', function(Builder $builder){
            /**
             * Paid amount can return number or null. I don't want it return null but 0
             * so I add IFNULL function to query
             *
             * NOTE: @property $paid_amount return in string type. So I
             *       put @property $casts in this model
             */
            $builder->select(\DB::raw('termin_details.*, ( SELECT IFNULL( SUM(amount), 0) FROM termin_payments WHERE termin_payments.termin_detail_id = termin_details.id ) AS paid_amount'));
        });
        // When retrieve all termin_detail records of a termin record, I want it ordered by due_date in default.
        // NOTE: now the table has column 'serial number' that can be used as alternative in ordering
        static::addGlobalScope('orderByDueDate', function(Builder $builder){
            $builder->orderBy('due_date', 'asc');
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
