<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentCommission extends Model
{
    protected $table =  'commissions';
    protected $fillable = ['amount'];
    public $timestapms = false;
}
