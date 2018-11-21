<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentCommission extends Model
{
    protected $table =  'agent_commissions';
    protected $fillable = ['due_date','amount'];
    public $timestapms = false;

    public function commissionHistory()
    {
        return $this->hasMany('App\AgentCommissionPayment');
    }
}
