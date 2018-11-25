<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icon', 'name',
   ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ ];

    public $timestamps = false;

    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function potential_projects()
    {
        return $this->hasMany('App\PotentialProject');
    }
}
