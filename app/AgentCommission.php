<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AgentCommission extends Model
{
    protected $table =  'agent_commissions';
    protected $fillable = ['due_date','amount'];
    public $timestapms = false;

    public function commissionHistory()
    {
        return $this->hasMany('App\AgentCommissionPayment');
    }

    protected static function boot()
    {
        parent::boot();

        // Now we have @property paid_amount that very useful, represent money that client has been paid
        static::addGlobalScope('withPaidAmountColumn', function(Builder $builder){
            /**
             * Paid amount can return number or null. I don't want it return null but 0
             * so I add IFNULL function to query
             */
            $builder->select(\DB::raw('agent_commissions.*, ( SELECT IFNULL( SUM(amount), 0) FROM agent_commission_payments WHERE agent_commissions.id = agent_commission_payments.agent_commission_id ) AS paid_amount'));
        });

    }
}
