<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentProject extends Model
{
    protected $table = 'agent_projects';
    protected $fillable = ['project_name'];
    public $timestamps = false;

    public function commission()
    {
        return $this->hasOne('App\AgentCommission','agent_project_id');
    }
}
