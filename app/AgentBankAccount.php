<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentBankAccount extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['bank_account'];
    // protected $table = 'agent_bank_accounts';
}
