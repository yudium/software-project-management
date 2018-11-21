<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AgentCommissionPayment extends Model
{
    protected $table =  'agent_commission_payments';
    protected $fillable = ['pay_date','amount','photo_evidance'];
    public $timestamps = false;

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }
}
