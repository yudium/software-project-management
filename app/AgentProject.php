<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentProject extends Model
{

    const IS_ACCEPTED = '0';
    const IS_REJECTED   = '1';

    protected $table = 'agent_projects';
    protected $fillable = ['project_name','status','note'];
    public $timestamps = false;

    public function commission()
    {
        return $this->hasOne('App\AgentCommission','agent_project_id');
    }

    public function project_type()
    {
        return $this->belongsTo('App\ProjectType');
    }

    public function getIsAccepted()
    {
        return $this->status == self::IS_ACCEPTED;
    }

    public function getIsRejected()
    {
        return $this->status == self::IS_REJECTED;
    }

}
