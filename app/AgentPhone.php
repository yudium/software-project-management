<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentPhone extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['phone'];
    // protected $table = 'agent_bank_accounts';
}
