<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentEmail extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['email'];
    // protected $table = 'agent_emails';
}
