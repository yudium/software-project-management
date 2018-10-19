<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentWebAddresses extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['web_address'];
    // protected $table = 'agent_bank_accounts';
}
